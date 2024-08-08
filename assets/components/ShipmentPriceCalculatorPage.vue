<template>
  <div class="weight-selector">
    <form @submit.prevent="getShippingPrice">
      <div class="field">
        <label for="weight">Weight in kg:</label>
        <input
            type="number"
            id="weight"
            v-model.number="weight"
            placeholder="Shipment weight"
        />
      </div>

      <div class="field">
        <label for="item">Transfer Company:</label>
        <select id="item" v-model="transferCompanyId">
          <option v-for="item in transferCompanies" :key="item.id" :value="item.id">
            {{ item.name }}
          </option>
        </select>
      </div>

      <button type="submit">Get Shipping Price</button>
    </form>

    <div class="result" v-if="shippingPrice !== null">
      <p>Total shipping price: {{ shippingPrice }} EUR</p>
    </div>

    <div class="error" v-if="errorMessage">
      <p>Error: {{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      weight: 0.0,
      transferCompanyId: null,
      transferCompanies: [],
      shippingPrice: null,
      errorMessage: null
    };
  },
  created() {
    this.fetchTransferCompanies();
  },
  methods: {
    async fetchTransferCompanies() {
      try {
        const response = await axios.get('/api/transfer-company/list');
        this.transferCompanies = response.data.data;
      } catch (error) {
        console.error('Error fetching transfer companies:', error);
      }
    },
    async getShippingPrice() {
        try {
          const response = await axios.get('/api/shipping/get-price', {
            params: {
              weight: this.weight,
              transferCompanyId: this.transferCompanyId
            }
          });
          this.shippingPrice = response.data.data;
          this.errorMessage = null;
        } catch (error) {
          console.log(error.response.data);
          if (error.response.data.error !== undefined) {
            this.errorMessage = error.response.data.error;
          }else if (error.response.data.detail !== undefined) {
            this.errorMessage = error.response.data.detail;
          }
          this.shippingPrice = null;
        }
    }
  }
};
</script>

<style scoped>
.weight-selector {
  display: flex;
  flex-direction: column;
  max-width: 400px;
  margin: auto;
}

.field {
  margin-bottom: 16px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

input[type="number"], select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  margin-top: 16px;
  padding: 8px;
  background-color: #007bff;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.result {
  margin-top: 16px;
  font-size: 16px;
  font-weight: bold;
}

.error {
  margin-top: 16px;
  font-size: 16px;
  color: red;
}
</style>

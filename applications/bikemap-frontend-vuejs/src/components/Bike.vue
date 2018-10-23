<template>
  <div v-bind:class="[bikeStatusClass]">
    {{ bike.id }}
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Bike',
  props: {
    bike: Object,
  },
  components: {},
  data() {
    return {
      bikeStatusClass: '',
    };
  },
  created() {
    this.bikeStatusClass = 'foo';
  },
  methods: {
    randomReservation: (bikeId) => {
      const http = axios.create({
        baseURL: process.env.VUE_APP_API_BASE_URL || '',
      });

      /**
       * - Add window confirmation dialog to confirm user action
       * - Create random reservation via `/reservations/random/${bikeId}` endpoint
       */
    },
    deleteReservation: (reservationId) => {
      const http = axios.create({
        baseURL: process.env.VUE_APP_API_BASE_URL || '',
      });

      /**
       * - Add window confirmation dialog to confirm user action
       * - Delete reservation via `/reservations/${reservationId}` endpoint
       */
    },
  }
}
</script>

<style>
/*
  - Unreserved: transparent circle and #999 border
  - Reserved: #ffdd15 circle and border
  - First ride: #abcc25 circle and border
  - Milestone (5, 10, 20, 50): #31aade circle and border
*/
</style>

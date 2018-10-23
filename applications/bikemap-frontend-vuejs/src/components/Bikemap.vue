<template>
  <div class="bikemap-dashboard">
    <p v-show="isFetching" class="fetching">
      <em>Fetching bikemap...</em>
    </p>

    <template v-if="!isFetching">
      <table class="bikemap">
        <tr v-for="row, i in bikemapData">
          <td v-for="bike, j in row">
            <Bike
              v-if=bike
              v-bind:bike="bike"
            ></Bike>
            <div v-else class="empty-spot">&nbsp;</div>
          </td>
        </tr>
      </table>

      <h2>Key</h2>
      <div>
        <div class="bikemap-key-entry">
          <div class="bikemap-key-item bikemap-key-item--unreserved" /> = unreserved
        </div>
        <div class="bikemap-key-entry">
          <div class="bikemap-key-item bikemap-key-item--reserved" /> = reserved
        </div>
        <div class="bikemap-key-entry">
          <div class="bikemap-key-item bikemap-key-item--first-ride" /> = first ride
        </div>
        <div class="bikemap-key-entry">
          <div class="bikemap-key-item bikemap-key-item--milestone" /> = milestone
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import axios from 'axios';
import Bike from './Bike';

export default {
  name: 'Bikemap',
  props: {},
  components: {
    Bike,
  },
  data() {
    return {
      isFetching: true,
      bikemapData: [],
    };
  },
  created() {
    const http = axios.create({
      baseURL: process.env.VUE_APP_API_BASE_URL || '',
    });

    let maxX = 0;
    let maxY = 0;
    let bikes = {};

    http.get('/bikemap')
      .then(response => {
        response.data.forEach(element => {
          bikes[element.x_coordinate + '_' + element.y_coordinate] = element;
          if (element.x_coordinate > maxX) {
            maxX = element.x_coordinate;
          }

          if (element.y_coordinate > maxY) {
            maxY = element.y_coordinate;
          }
        });

        for (let j = 0; j <= maxY; j++) {
          this.bikemapData[j] = [];
          for (let i = 0; i <= maxX; i++) {
            this.bikemapData[j][i] = bikes[`${i}_${j}`];
          }
        }

        this.isFetching = false;
      })
      .catch(error => {
        console.log('error :(');
        console.log(error);
      });
  },
}
</script>

<style>
.empty-spot {
  padding: 15px;
}

.bikemap-key-entry {
  margin: 0 0 10px;
}
.bikemap-key-item {
  border: 1px solid #999;
  float: left;
  height: 15px;
  margin-right: 5px;
  width: 15px;
}
.bikemap-key-item--first-ride {
  background: #abcc25;
  border-color: #abcc25;
}
.bikemap-key-item--milestone {
  background: #31aade;
  border-color: #31aade;
}
.bikemap-key-item--reserved {
  background: #ffdd15;
  border-color: #ffdd15;
}
</style>

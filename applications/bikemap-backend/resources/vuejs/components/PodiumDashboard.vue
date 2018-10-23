<template>
  <div class="podium-dashboard">
    <h1>Foo Bar</h1>
  </div>
</template>

<script>
// import axios from 'axios';

export default {
  name: 'PodiumDashboard',
  props: {
    // msg: String,
  },
  components: {
    Header,
    Deployment,
    CronJob,
    Job,
    DaemonSet,
  },
  data() {
    return {
      // deployments: [],
      // deploymentErrorMessage: '',
      // isFetchingDeployments: true,
      // jobs: [],
      // jobErrorMessage: '',
      // isFetchingJobs: true,
      // cronjobs: [],
      // cronjobErrorMessage: '',
      // isFetchingCronJobs: true,
      // daemonsets: [],
      // daemonsetErrorMessage: '',
      // isFetchingDaemonSets: true,
    };
  },
  created() {
    //
    // const http = axios.create({
    //   baseURL: process.env.VUE_APP_API_BASE_URL || '',
    // });
  },
}
</script>

<style>
  h2 {
    color: #f00;
  }
</style>

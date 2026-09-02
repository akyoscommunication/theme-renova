// import axios from 'axios';

const baseURL = `${window.location.protocol}//${window.location.hostname}` + window.location.port ? `:${window.location.port}` : '';
export class app {

  static apiEndpoint = `${baseURL}/wp-json/api`;

}


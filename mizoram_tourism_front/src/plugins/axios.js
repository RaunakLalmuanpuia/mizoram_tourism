import axios from "axios";
import decode from "jwt-decode";

const instance = axios.create({
  headers: { "Content-type": "application/json" },
  baseURL: "/api/"
});

instance.interceptors.request.use(
  config => {
    let originalRequest = config;
    if (
      typeof localStorage.token === "undefined" ||
      localStorage.token === "undefined"
    ) {
      return config;
    }

    let token = decode(localStorage.token);
    if (token.exp <= new Date().getTime() / 1000) {
      return axios
        .post(
          "/oauth/token/refresh",
          { token: localStorage.token },
          {
            headers: {
              Authorization: "Bearer " + localStorage.token
            }
          }
        )
        .then(res => {
          originalRequest.headers.Authorization = "Bearer " + res.data.token;
          localStorage.token = res.data.token;
          return Promise.resolve(originalRequest);
        });
    }
    config.headers.Authorization =
      "Bearer " + localStorage.token;
    // let user = JSON.parse(localStorage.user)
    return config;
  },
  err => {
    return Promise.reject(err);
  }
);

export default instance;
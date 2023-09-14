import axios from "./axios";

const API_URL = "http://localhost:8000/api/";

class AuthService {
  async login(user) {
    return axios
      .post(API_URL + signin, {
        username: user.username,
        password: user.password,
      })
      .then(res => {
        if (res.data.accessToken) {
          localStorage.setItem('user', JSON.stringify(res.data))
        }
        return res.data;
      });
  }
  logout() {
    localStorage.removeItem('user');
  }
  async register(user) {
    const res = await axios
      .post(API_URL + 'register', {
        username: user.username,
        email: user.email,
        password: user.password,
      });
    if (res.data.accessToken) {
      localStorage.setItem('user', JSON.stringify(res.data));
    }
    return res.data;
  }
}

export default new AuthService();
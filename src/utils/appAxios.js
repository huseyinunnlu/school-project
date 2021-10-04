import axios from "axios";
import CryptoJS from "crypto-js";
let decryptToken = localStorage.getItem("token");
let bytes = null
let decryptedToken = null
if (decryptToken) {
  bytes = CryptoJS.AES.decrypt(decryptToken, "vuexisawesomesecret");
  decryptedToken = bytes.toString(CryptoJS.enc.Utf8);
}
export const appAxios = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    Authorization: decryptedToken,
  },
});

import axios from "axios";

export default class AxiosHelper {
  private mode = "";

  constructor() {
    if (process) {
      if (process.env) {
        const mode = process.env["NODE_ENV"] as string;
        if (mode) {
          this.mode = mode.trim().toLowerCase();
        } else {
          this.mode = "production";
        }
      }
    }
  }

  public GET(url: string, params: object | null = null) {
    return axios.get(url, {
      baseURL: this.mode === "production" ? undefined : "http://localhost:8080",
      params: params
    });
  }

  public POST(url: string, data: object | null = null) {
    return axios.post(url, data, {
      baseURL: this.mode === "production" ? undefined : "http://localhost:8080"
    });
  }
}

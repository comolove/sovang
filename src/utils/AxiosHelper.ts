import axios from "axios";

export default class AxiosHelper {
  public static GET(url: string, params: object | null = null) {
    return axios.get(url, {
      baseURL: AxiosHelper.baseURL,
      params: params
    });
  }

  public static POST(url: string, data: object | null = null) {
    return axios.post(url, data, {
      baseURL: AxiosHelper.baseURL
    });
  }

  public static get mode(): string {
    if (process) {
      if (process.env) {
        const mode = process.env["NODE_ENV"] as string;

        if (mode) {
          return mode.trim().toLowerCase();
        }
      }
    }

    return "development";
  }

  private static get baseURL(): string | undefined {
    return AxiosHelper.mode === "production"
      ? undefined
      : "http://localhost:8080";
  }
}

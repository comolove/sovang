import axios from "axios";

export default class AxiosHelper {
  public static GET(
    url: string,
    params: object | null = null,
    config: object | null = null
  ) {
    const mergedConfig = AxiosHelper.mergeObject(
      {
        baseURL: AxiosHelper.baseURL,
        params: params
      },
      config
    );

    return axios.get(url, mergedConfig);
  }

  public static POST(
    url: string,
    data: object | null = null,
    config: object | null = null
  ) {
    const mergedConfig = AxiosHelper.mergeObject(
      {
        baseURL: AxiosHelper.baseURL
      },
      config
    );

    return axios.post(url, data, mergedConfig);
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

  private static mergeObject(base: object | null, dest: object | null) {
    return { ...base, ...dest };
  }
}

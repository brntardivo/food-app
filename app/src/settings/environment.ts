import * as Updates from "expo-updates";

interface IEnv {
  API_URL: string;
}

const development = {
  API_URL: "http://api.food.localhost/api",
};

const production = {
  API_URL: "https://api.food.com/api",
};

const environment: IEnv = Updates.releaseChannel.startsWith("prod")
  ? production
  : development;

export default environment;

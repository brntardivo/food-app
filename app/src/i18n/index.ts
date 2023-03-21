import i18n from "i18next";
import { Platform, NativeModules } from "react-native";
import { initReactI18next } from "react-i18next";
import pt_BR from "@i18n/translations/pt_BR.json";
import en_US from "@i18n/translations/en_US.json";

const getLang = (): string => {
  return Platform.OS === "ios"
    ? NativeModules.SettingsManager.settings.AppleLocale // ios
    : NativeModules.I18nManager.localeIdentifier; // android
};

i18n.use(initReactI18next);

i18n
  .init({
    lng: getLang(),
    compatibilityJSON: "v3",
    resources: {
      pt_BR: {
        translation: pt_BR,
      },
      en_US: {
        translation: en_US,
      },
    },
    fallbackLng: "pt_BR",
    interpolation: {
      escapeValue: false,
    },
  })
  .catch((err) => {
    console.warn(err);
  });

export default i18n;

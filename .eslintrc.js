module.exports = {
  env: {
    browser: true,
    es6: true,
  },
  extends: "eslint:recommended",
  rules: {
    indent: ["error", 2],
    "linebreak-style": ["error", "windows"],
    quotes: ["error", "double", { allowTemplateLiterals: true }],
    semi: ["error", "always"],
    "no-use-before-define": ["error", { functions: true, classes: true }],
    strict: ["error", "global"],
  },
};

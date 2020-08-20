module.exports = {
  presets: [["@babel/preset-env",
  {
    useBuiltIns: 'usage',
    targets: {
      browsers: ['>1%', 'last 2 versions'],
      ie: '11'
    },
    corejs: 3
  }
    ], 
  "@vue/cli-plugin-babel/preset"]
};

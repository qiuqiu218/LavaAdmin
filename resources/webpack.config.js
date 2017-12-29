const path = require("path")
const webpack = require("webpack")
// 引入插件
const HTMLWebpackPlugin = require("html-webpack-plugin")
// 抽取 css
const ExtractTextPlugin = require("extract-text-webpack-plugin")

const DEBUG = process.env.NODE_ENV !== 'production'
const basePlugins = [
  new ExtractTextPlugin(path.join('../', 'css', '[name].css')),
]

// 将src目录下所有的js文件都批量匹配加入到entry中
const glob = require('glob')
const files = glob.sync('./src/**/*.js');
const entry = {};
files.forEach(file => {
  var name = file.match(/src\/(.*?).js/)[1]
  entry[name] = file
});
entry.vendor = ['jquery', 'babel-polyfill', './src/stylus/main.styl']

module.exports = {
  entry: entry,
  output: {
    path: path.resolve(__dirname, '../public', 'js'),
    filename: '[name].js',
  },
  resolve: {
    extensions: ['.js', '.styl'],
    alias: {
      '_assets': path.join(__dirname, 'assets')
    }
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /(node_modules|bower_components)/
      },
      {
        test: /\.(gif|jpg|png|woff|svg|eot|ttf)\??.*$/,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 8192
            }
          }
        ]
      },
      {
        test: /\.(css|styl)$/,
        exclude: /node_modules/,
        use: ExtractTextPlugin.extract({
          fallback: "style-loader",
          use: ['css-loader', 'stylus-loader']
        })
      },
      {
        test: require.resolve('jquery'),
        use: [{
            loader: 'expose-loader',
            options: 'jQuery'
        },{
            loader: 'expose-loader',
            options: '$'
        }]
      }
    ]
  },
  plugins: DEBUG ? basePlugins : basePlugins.concat([
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': '"production"'
    }),
  ])
}
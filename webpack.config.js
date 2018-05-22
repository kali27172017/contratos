const path = require('path')
const ExtractTextPlugin = require('extract-text-webpack-plugin')


module.exports = {
    entry:{
       admin:path.resolve(__dirname,'client_dev/js/index.js')
    },
    output:{
        path: path.resolve(__dirname,'dist'),
        filename:'js/[name].js'
    },
    devServer:{
        port:9000
    },
    module:{
        rules:[
            {
                test:/\.js$/,
                use:{
                    loader:'babel-loader',
                    options:{
                        presets:['es2015']
                    }
                }
            },
            {
                test:/\.(jpg|png|gif|woff|eot|ttf|svg|woff2)$/,
                use:{
                    loader:'url-loader',
                    options:{
                        limit:100000
                    }
                }
            },
           {
               test:/\.css$/,
               use: ExtractTextPlugin.extract({
                fallback: "style-loader",
                use: "css-loader"
              })
           },
           {
            test:/\.scss$/,
            use: ExtractTextPlugin.extract({
             use: ["css-loader","sass-loader"]
             })
           }  

        ]
    },
    plugins: [
        new ExtractTextPlugin("css/[name].css")
      ]
}
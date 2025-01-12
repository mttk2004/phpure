const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode   : 'development', // Change to 'production' in production environment
	entry  : {
		app   : './resources/js/app.js',
		styles: './resources/css/input.css',
	},
	output : {
		filename: '[name].js',
		path    : path.resolve(__dirname, 'public/assets'),
		clean   : true, // Clean the output directory before build
	},
	module : {
		rules: [
			{
				test: /\.css$/,
				use : [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader', // Add postcss-loader here
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
															 filename: '[name].css',
														 }),
	],
};

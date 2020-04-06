const markdownpdf = require("markdown-pdf");

const options = {
	remarkable: {
		html: true,
		breaks: true,
	}
};

markdownpdf(options).from("./README.md").to("./README.pdf", () => {
	console.log("Generated successfully")
});



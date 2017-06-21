var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "../image/bg/1.jpg",
		        "../image/bg/2.jpg",
		        "../image/bg/3.jpg",
		        "../image/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();
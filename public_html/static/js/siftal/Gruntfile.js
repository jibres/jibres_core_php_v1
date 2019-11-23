var fs = require('fs');
exec = require('child_process').exec;

var myModuleFiles =
[
	// nojquery, init
	'src/libs/logy/logy.js',

	// include jquery
	'src/libs/jquery/jquery-3.4.1.min.js',
	'src/libs/jquery/jquery-fn.js',

	'src/libs/localstorage.js',
	'src/libs/modal/modal.js',
	'src/libs/utils.js',
	'src/libs/underscore.js',

	// new lib used in siftal
	'src/libs/clockpicker/jquery-clockpicker.js',
	'src/libs/clockpicker/clockpickerRunner.js',

	'src/libs/date/persian-date.js',
	'src/libs/date/persian-datepicker.js',
	'src/libs/date/runDatepicker.js',

	// 'src/libs/cropper/cropper.js',
	// 'src/libs/cropper/cropperRunner.js',
	'src/libs/dataResponse/dataResponse.js',
	'src/libs/sortable/Sortable.js',
	'src/libs/sortable/SortableRunner.js',

	'src/libs/counter/jquery.counterup.js',
	'src/libs/counter/counterRunner.js',
	'src/libs/notif/iziToast.js',
	'src/libs/notif/notif.js',
	'src/libs/codeReader/codeReader.js',
	'src/libs/cursor/cursor.js',
	'src/libs/tagDetector/tagDetector.js',
	'src/libs/tippy/tippy.min.js',
	'src/libs/tippy/tippyRunner.js',
	'src/libs/uploader/uploader.min.js',
	'src/libs/uploader/uploaderRunner.js',
	'src/libs/shortkey/shortkey.js',
	'src/libs/nprogress/nprogress.js',
	'src/libs/pingi/pingi.js',
	'src/libs/wordify/wordify.js',
	'src/libs/cloner/cloner.js',
	'src/libs/alerty/alerty.min.js',
	'src/libs/alerty/alerty-runner.js',
	'src/libs/escNav/escNav.js',
	'src/libs/kerkere/kerkere.js',
	'src/libs/dataCopy/dataCopy.js',

	// select2
	'src/libs/select2/select2.full.min.js',
	'src/libs/select2/fa.js',
	'src/libs/select2/select2Runner.js',

	// semantic
	'src/libs/semantic-ui/api/api.min.js',
	'src/libs/semantic-ui/transition/transition.min.js',
	'src/libs/semantic-ui/dropdown/dropdown.min.js',
	'src/libs/semantic-ui/dropdown/dropdownRunner.js',



	// tools
	'src/tools/navigate.js',
	'src/tools/forms.js',

	// use some utitlity
	'src/utility/fnCaller.js',
	'src/utility/fitNumber.js',
	'src/utility/urlParam.js',
	'src/utility/shrink.js',
	'src/utility/print.js',
	'src/utility/dataRunner.js',
	'src/utility/formTools.js',
	'src/utility/smileChecker.js',
	'src/utility/table.js',
	'src/utility/noscriptRemover.js',

	'src/utility/clock.js',
	'src/utility/input-files.js',
	'src/utility/language.js',
	'src/utility/responsive.js',
	'src/utility/life.js',
	'src/utility/enter.js',
	'src/utility/pay.js',
	'src/utility/weAreHere.js',
	'src/utility/json.js',
	'src/utility/smoothScroll.js',
	'src/utility/inputChecker.js',
	'src/utility/inputRequirement.js',
	'src/utility/navigateChecker.js',
	'src/utility/catchBeforeUnload.js',
	'src/utility/serviceWorker.js',



	'src/main.js',
	'src/load.js',
	'src/pushState.js',
];



module.exports = function (grunt)
{
	grunt.initConfig(
	{
		uglify:
		{
			options:
			{
				sourceMap: false,
				mangle: false
			},
			siftal:
			{
				files:
				{
					'../siftal.min.js': myModuleFiles,
				}
			}
		},
		watch:
		{
			siftal:
			{
				files: myModuleFiles,
				tasks: ['uglify:siftal']
			},
			scripts:
			{
				files: ['*.js'],
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify-es');

	grunt.registerTask('default', ['uglify', 'watch']);
};



	
	// document.querySelector('#btn-print').addEventListener('click', function () {
	// 	// window.print();

	// 	let wspFrame = document.getElementById('frame').contentWindow;
	// 	wspFrame.focus();
	// 	wspFrame.print();
	// });

	 document.querySelector('#exportic').addEventListener('click', function () {
		html2canvas(document.querySelector('#report_pdf4')).then((canvas) => {
		let base64image = canvas.toDataURL('image/png');
		console.log(base64image);
		let pdf = new jsPDF('p', 'px', [1200, 1700]);
			pdf.addImage(base64image, 'PNG', 200, 15, 800, 1000);
			pdf.save('webtylepress-two.pdf');
	 	});
	 });


/*	const element = document.querySelector('#report_pdf2');
document.addEventListener('DOMContentLoaded', function () {

	const trigger = document.querySelector('#exportic'); 
	trigger.addEventListener('click', function () {

		const opt = {
			filename:     'Report.pdf',
			image:        { type: 'jpeg', quality: 0.98 },
		html2canvas:  { 
				margin: 1,
				scale: 2,
				dpi: 192, 
				letterRendering: true,
				scrollY: -(window.scrollY - 600),
				windowWidth: document.documentElement.offsetWidth,
				height: element.offsetHeight + 50,
				// allowTaint: true,
				// ignoreElements: (element) => {
				// 	if(element.classList.includes('exportic')) false
				// },
				// onclone: (document) => {
				// 	// console.log(document)
				// 	// document.querySelector('.sc_page1_desc').classList.add('d-none')
				// 	const downloadPDFBtn = document.querySelector('#exportic');
				// 	downloadPDFBtn.style.display = 'none';
				// 	// document.querySelector('.sc_page1_desc').style.width = '100%'
				// },
			},
			
			jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
		};
		html2pdf().set(opt).from(element).save();
	});
});      */
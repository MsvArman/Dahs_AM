$(function() {

	$('#fund_type').multiselect({
	  columns: 1,
	  placeholder: 'نوع صندوق ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});
	$('#fund_manager').multiselect({
	  columns: 1,
	  placeholder: 'مدیر صندوق ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});
	$('#fund_name').multiselect({
	  columns: 1,
	  placeholder: 'نام صندوق ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});

	$('#report_type').multiselect({
	  columns: 1,
	  placeholder: 'نوع صندوق ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});


	$('#bar_report_type').multiselect({
	  columns: 1,
	  placeholder: 'نوع صندوق ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});

    $('.charts_report_type').multiselect({
	  columns: 1,
	  placeholder: 'نوع گزارش ...',
	  search: true,
	  searchOptions: {
	      'default': 'جستجو کنید...'
	  },
	  selectAll: true
	});

});

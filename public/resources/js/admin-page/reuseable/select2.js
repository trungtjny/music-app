$(function(){
    $('.select2-single').select2({
        placeholder: "Select a state",
    });

    $('.select2-multiple').select2({
        placeholder: "--- Chọn nhiều lựa chọn ---",
        theme: 'classic',
        closeOnSelect: true,
    });
})

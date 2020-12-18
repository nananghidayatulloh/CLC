const flashData = $('.flash-data').data('flashdata');
const flashAkun = $('.flash-akun').data('flashakun');
const flashError = $('.flash-error').data('flasherror');

if (flashData) {
    Swal({
        title: 'Berhasil',
        text: flashData,
        type: 'success'
    });
}

if (flashAkun) {
    Swal({
        title: 'Akun Kamu',
        text: flashAkun,
        type: 'success'
    });
}

if (flashError) {
    Swal({
        title: 'MAAF',
        text: flashError,
        type: 'error'
    });
}

//tombol_hapus
$('.tombol_hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin?',
        text: 'Data akan dihapus',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});
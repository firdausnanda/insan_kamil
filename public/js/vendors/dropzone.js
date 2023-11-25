Dropzone.autoDiscover = !1;
const myDropzone = new Dropzone("#my-dropzone", {
    url: "{{ route('admin.produk.store) }}",
    maxFilesize: 4,
    acceptedFiles: "image/*",
    addRemoveLinks: !0,
    autoProcessQueue: !0,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
});
myDropzone.on("addedfile", function (o) {
    console.log("File added: " + o.name)
}), myDropzone.on("removedfile", function (o) {
    console.log("File removed: " + o.name)
}), myDropzone.on("success", function (o, e) {
    console.log("File uploaded successfully:", e)
});

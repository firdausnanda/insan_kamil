var quill;
$("#editor").length && (quill = new Quill("#editor", {
    modules: {
        toolbar: [
            [{
                header: [1, 2, !1]
            }],
            [{
                font: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
                size: ["small", !1, "large", "huge"]
            }],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }],
            [{
                color: []
            }, {
                background: []
            }, {
                align: []
            }],
            ["link", "image", "code-block", "video"]
        ]
    },
    theme: "snow"
}));

$("#editor2").length && (quill = new Quill("#editor2", {
    modules: {
        toolbar: [
            [{
                header: [1, 2, !1]
            }],
            [{
                font: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
                size: ["small", !1, "large", "huge"]
            }],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }],
            [{
                color: []
            }, {
                background: []
            }, {
                align: []
            }],
            ["link", "image", "code-block", "video"]
        ]
    },
    theme: "snow"
}));

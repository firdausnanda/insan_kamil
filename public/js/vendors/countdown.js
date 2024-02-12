$("[data-countdown]").each(function () {
    var n = $(this),
        s = $(this).data("countdown");
    n.countdown(s, function (n) {
        $(this).html(n.strftime('<span class="countdown-section"><span class="countdown-amount hover-up">%D</span><span class="countdown-period"> hari </span></span><span class="countdown-section"><span class="countdown-amount hover-up">%H</span><span class="countdown-period"> jam </span></span><span class="countdown-section"><span class="countdown-amount hover-up">%M</span><span class="countdown-period"> menit </span></span><span class="countdown-section"><span class="countdown-amount hover-up">%S</span><span class="countdown-period"> detik </span></span>'))
    })
});

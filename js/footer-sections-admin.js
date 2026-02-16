(function ($) {
  "use strict";

  $(function () {
    var frame;

    function setPreview(attachment) {
      if (!attachment || !attachment.id) return;
      $("#tfs_footer_logo").val(attachment.id);
      var url =
        attachment.sizes &&
        attachment.sizes.medium &&
        attachment.sizes.medium.url
          ? attachment.sizes.medium.url
          : attachment.url;
      $("#tfs_footer_logo_preview").html(
        '<img src="' + url + '" style="max-height:60px;width:auto;" />'
      );
    }

    $("#tfs_footer_logo_select").on("click", function (e) {
      e.preventDefault();

      if (frame) {
        frame.open();
        return;
      }

      frame = wp.media({
        title: "Select footer logo",
        button: { text: "Use this image" },
        library: { type: "image" },
        multiple: false,
      });

      frame.on("select", function () {
        var attachment = frame.state().get("selection").first().toJSON();
        setPreview(attachment);
      });

      frame.open();
    });

    $("#tfs_footer_logo_remove").on("click", function (e) {
      e.preventDefault();
      $("#tfs_footer_logo").val("");
      $("#tfs_footer_logo_preview").empty();
    });
  });
})(jQuery);


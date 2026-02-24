<section id="{{ esc_attr($uid) }}" class="info" style="background: {{ esc_attr($sectionBg) }};">

  <div class="info-container">
    @if(!empty($text))
      <h2 class="heading_info">  {!! wp_kses_post($text, $allowedHeadingHtml) !!} </h2>
    @endif

    @if(!empty($paragraph))
      <p class="p_info">  {!! wp_kses_post($paragraph, $allowedHeadingHtml) !!} </hp>
    @endif
  </div>
</section>

<style>

  .info {
    padding: 0px !important;
  }
.heading_info {
    font-size: clamp(3.8rem, 3.8rem + (1vw - .375rem) * 3.6994219653, 4.2rem);
    max-width: 65%;
    line-height: .85;

}

.info-container {
  display: flex;
  justify-content: space-between;
  max-width: 1000px;
margin: auto;
align-items: center;
}

.p_info {
  max-width: 30%;
  color: #0F2A84  ;
}

</style>
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

  @media (min-width: 600px) {

.heading_info {
    max-width: 65%;
}
.p_info {
  max-width: 30%;
}
  }

.info-container {
  display: flex;
  justify-content: space-between;
  max-width: 1000px;
margin: auto;
align-items: center;
}




@media (max-width: 600px) {
  
    .info-container {
      display: flex;
      flex-direction: column;
    }
    .membership-offer__image {
      display: none;
    }
    .info {
      padding-left: 16px;
      padding-right: 16px;
    }
    .info img,
    .info video {
      max-width: 100%;
      height: auto;
    }
    .info [class*="grid"],
    .info [class*="cards"],
    .info [class*="columns"],
    .info [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
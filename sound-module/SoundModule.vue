<template>
  <section
    class="component component--sound-module sound-module"
    >
    <picture class="sound-module__picture">
      <source
        v-if="mobileImage"
        :srcset="mobileImage.url"
        media="(max-width: 767px)"
      >
      <source
        v-if="image"
        :srcset="image.url"
        media="(min-width: 768px)"
      >
      <img
        :src="image.url"
        :alt="image.alt"
        class="sound-module__bg-image"
      />
    </picture>
    <h2
      class="sound-module__heading h4"
      v-html="heading"
    >
    </h2>
    <div class="sound-module__links cta-group">
      <AppLink
        v-for="(link, index) in links"
        :key="`sound-module__links--${index}`"
        :to="link.link.url"
        :target="link.link.target"
        v-html="link.link.title"
        class="sound-module__link btn btn--main text-link text-link--light"
      >
       <span class="svg svg--arrow-cta svg--arrow-cta-light" v-html="ArrowCta"></span>
      </AppLink>
    </div>
    <div
      v-if="audioFile"
      class="sound-module__controls">
      <button
        v-if="!this.isPlaying"
        v-html="Play"
        class="svg svg--play"
        @click="togglePlay()"
      >
      </button>
      <button
        v-if="this.isPlaying"
        v-html="Pause"
        class="svg svg--pause"
        @click="togglePlay()"
      >
      </button>
      <audio
        :src="audioFile.url"
        type="audio/mpeg"
        ref="audio"
        preload=”metadata” loop
      />
    </div>
  </section>
</template>

<script>
  import ArrowCta from '~/assets/icons/arrow-cta.svg?raw'
  import Play from '~/assets/icons/play.svg?raw'
  import Pause from '~/assets/icons/pause.svg?raw'

  export default {
    name: 'SoundModule',
    props: ['component'],

    data() {
      return {
        isPlaying: false,
        ArrowCta,
        Play,
        Pause
      }
    },

    computed: {
      image() {
        return this.component.image
      },

      mobileImage() {
        return this.component.mobile_image
      },

      heading() {
        return this.component.heading
      },

      links() {
        return this.component.links
      },

      audioFile() {
        return this.component.audio_file
      }
    },

    methods: {
      togglePlay() {
        this.isPlaying = !this.isPlaying
        if (this.isPlaying === false) {
          this.$refs.audio.pause()
        } else {
          this.$refs.audio.play()
        }
      }
    }
  }
</script>

<style lang="scss">
  @import './SoundModule.scss';
</style>

<template>
  <main id="content">

    <nav class="blog-navigation">
      <div class="blog-navigation__links--desktop">
        <button
          class="blog-navigation__link view-all"
          v-if="this.isFiltered && !this.searchOpen"
          @click="unfilter"
        >VIEW ALL
        </button>
        <template
          v-for="(nav_item, index) in blogNav"
        >
          <EpLink
            class="blog-navigation__link"
            :to="nav_item.url"
            v-html="nav_item.title"
            :key="`blog-navigation__link-${index}`"
          >
          </EpLink>
        </template>
      </div>

      <button
        class="blog-navigation__link nav-trigger"
        @click="toggleMobileNav"
        >Categories
      </button>

      <div
        class="blog-navigation__links--mobile"
        :class="{ 'nav-open': this.mobileNavOpen }"
      >
        <button
          class="blog-navigation__link view-all"
          @click="unfilter"
        >VIEW ALL
        </button>

        <template
          v-for="(nav_item, index) in blogNav"
        >
          <EpLink
            class="blog-navigation__link"
            :to="nav_item.url"
            v-html="nav_item.title"
            :key="`blog-navigation__link-${index}`"
          >
          </EpLink>
        </template>
      </div>

      <button
        class="search-trigger"
        @click="toggleSearchNav"
      >
      </button>


      <aside
        class="component component--blog-search"
        :class="{ 'nav-open': this.searchOpen }"
        >

        <SearchDropdown
          :options="getPostTags"
          :disabled="false"
          name="search"
          placeholder="Search"
          :placeholder="this.$route.query.search"
          @initSearch="keyEnter"
        >
        </SearchDropdown>

        <button
          class="search-trigger--close"
          @click="toggleSearchNav"
        >+
        </button>
      </aside>
    </nav>


    <BlogLandingHero
      v-if="!isFiltered"
      :block="this.blog_landing_hero" />

    <component
      v-if="!isFiltered"
      v-for="(block, index) in blog_landing_components"
      :is="blockName(block)"
      :key="`blog-landing-component-${index}`"
      v-bind:block="block"
      >
    </component>

    <div
      v-if="isFiltered"
      class="filtered-post-grid filtered-post-grid--filtered"
    >
      <EpLink
        v-for="(post, index) in this.filteredPosts"
        :to="post.link"
        class="filtered-post-grid__post"
        :class="{ 'filtered-post-grid__post--no-image': !post.hasImage }"
        :key="`filtered-post-grid__post-${index}`"
      >
        <div
          v-if="post.hasImage"
          class="filtered-post-grid__image-wrapper"
        >
          <img
            :src="post.image.url"
            :alt="post.image.alt"
            class="filtered-post-grid__asset filtered-post-grid__image"
          >
        </div>

        <ul
          v-if="post.categories"
          class="filtered-post-grid__categories"
        >
          <li
            v-for="(category, index) in post.categories"
            :key="`categories-${index}`"
            class="filtered-post-grid__category"
            >
            <EpLink
              :to="category.link"
              :key="`filtered-post-grid__featured-post-link-${index}`"
              class="filtered-post-grid__category"
            >
              {{category.name}}
            </EpLink>
          </li>
        </ul>

        <h2
          class="filtered-post-grid__title">{{ post.title }}
        </h2>
        <p
          v-if="post.hasImage"
          v-html="$options.filters.truncate(post.copy, 100)"
          class="filtered-post-grid__excerpt">{{ post.copy }}
        </p>
        <p
          v-else
          v-html="$options.filters.truncate(post.copy, 300)"
          class="filtered-post-grid__excerpt">{{ post.copy }}
        </p>

      </EpLink>
    </div>

    <div
      class="no-results-content"
      v-if="noResults"
      >
      <p
      class="no-results-copy"
      v-html="this.no_results_copy"
      >
      </p>
    </div>

    <BlogRelatedSlider
      v-if="this.blog_related_slider && noResults"
      :block="this.blog_related_slider"
    />

  </main>
</template>

<script>
  import EpLink from '@/components/EpLink/EpLink.vue';
  import BlogLandingHero from '@/components/BlogLandingHero/BlogLandingHero.vue';
  import SearchDropdown from "@/components/SearchDropdown/SearchDropdown";
  import BlogRelatedSlider from "@/components/BlogRelatedSlider/BlogRelatedSlider";
  import FeaturedBlogSlider from '@/components/FeaturedBlogSlider/FeaturedBlogSlider.vue';
  import SpotlightSlider from '@/components/SpotlightSlider/SpotlightSlider.vue';
  import BlogFeaturedTwoColumn from '@/components/BlogFeaturedTwoColumn/BlogFeaturedTwoColumn.vue';
  import BlogFeaturedThreeColumn from '@/components/BlogFeaturedThreeColumn/BlogFeaturedThreeColumn.vue';
  import { normalizePost } from '@/helpers/blog.js'


export default {
  name: 'TemplateBlogLanding',
  props: ['blog_landing_components', 'blog_landing_hero', 'blog_related_slider', 'no_results_copy'],


  components: {
    EpLink,
    BlogLandingHero,
    SearchDropdown,
    BlogRelatedSlider,
    FeaturedBlogSlider,
    SpotlightSlider,
    BlogFeaturedTwoColumn,
    BlogFeaturedThreeColumn
  },

  data() {
    return {
      isFiltered: false,
      filteredPosts: [],
      searchOpen: false,
      mobileNavOpen: false
    }
  },

  mounted() {
    if (this.$route.query.search) {
      let query = this.$route.query.search
      this.keyEnter(query)
    }
  },

  computed: {
    blogNav() {
      return this.$store.state.blog_nav.menu_items
    },

    getPostTags() {
      let tags = this.$store.state.blogPosts.tags
      let searchTags = []

      if (tags) {
        for (var i = 0; i < tags.length; i++) {
          let singleTag = {}
          let title = tags[i]._source.name
          singleTag.id = i + 1
          singleTag.name = title
          searchTags.push(singleTag)
        }
      }

      return searchTags
    },

    noResults() {
      return this.isFiltered && this.filteredPosts.length === 0
    }
  },

  methods: {
    normalizePost,

    blockName: function(block) {
      let name = block.acf_fc_layout.replace('layout_', '')
      return name.split('_').map(n => `${n.charAt(0).toUpperCase()}${n.slice(1)}`).join('')
    },

    keyEnter(query) {
      let categories = this.$el.querySelectorAll('.blog-navigation__link')
      let mainNavs = this.$parent.$parent.$parent.$children
      let posts = this.$store.state.blogPosts.posts.filter(post => post._source.post_status === 'publish')

      this.isFiltered = true

      categories.forEach((category) => {
        if (category.classList.contains('nuxt-link-active')) {
          category.classList.remove('nuxt-link-active')
        }
      });

      // Filter posts and return in order of relevance: first query matches post title, matches taxonomy, then matches excerpt content
      if (query) {
        this.filteredPosts = posts.filter(post => {
          if (post._source.post_title.toLowerCase().includes(query.toLowerCase())) {
            return post
          }
          if (post._source.taxonomies) {
            for (var tag of post._source.taxonomies) {
              if (tag.name.toLowerCase().includes(query.toLowerCase())) {
                return post
              }
            }
          }
          if (post._source?.post_excerpt.toLowerCase().includes(query.toLowerCase())) {
            return post
          }
        })
        history.pushState(
          {},
          null,
          this.$route.path + '?search=' + encodeURIComponent(query)
        )

        window.scrollTo(0,0)

        // Nav behavior unique to the filtered Landing Page
        this.$el.querySelectorAll('.blog-navigation')[0].classList.add('is-fixed','is-static')
        mainNavs.forEach((nav) => {
          if ( nav._name == '<Navigation>' ) {
            nav.$el.querySelectorAll('.main-navigation')[0].classList.add('is-fixed','is-static')
          }
        })

        this.filteredPosts = this.filteredPosts.map(this.normalizePost)
      }

      this.searchOpen = true
      this.mobileNavOpen = false

    },

    toggleSearchNav() {
      this.mobileNavOpen = false
      this.searchOpen = !this.searchOpen
    },

    toggleMobileNav() {
      this.mobileNavOpen = !this.mobileNavOpen
    },

    // When page is filtered, View All button clears search query and reloads page
    unfilter() {
      let searchForm = this.$children.find(child => { return child._name === "<SearchDropdown>" })

      this.isFiltered = false
      this.$router.replace({'query': null})
      searchForm.searchData = ""
      this.$router.go(this.$route.path)
    }
  },

  filters: {
    truncate: function(string,limit){
        if (string) {
          let text = ''
          let elips = ''
          if (string.length > limit) {
            elips = '...'
          }
          text = string.split("").slice(0, limit).join("") + elips;
          return text;
        }
    }
  }
}
</script>

<style lang="scss">
  @import './TemplateBlogLanding';
  @import './BlogNav';
</style>

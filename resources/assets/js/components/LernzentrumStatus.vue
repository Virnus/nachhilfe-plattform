<template>
  <span class="tag" :class="{'is-danger': isFull, 'is-warning': isNearlyFull, 'is-info': isPending}">
      <template v-if="isFull">
        Voll
      </template>
      <template v-else>
        {{ current }} / {{ max }}
      </template>
  </span>
</template>

<script>
export default {
    props: ['max', 'current'],
    name: 'lernzentrum-status',
    computed: {
        isFull() {
            return this.current === this.max
        },
        isNearlyFull() {
            return this.current < this.max && this.current > this.max - 5
        },
        isPending() {
            return this.current <= this.max - 5
        }
    }
}
</script>

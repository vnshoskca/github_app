
<template>
  <div>
    <ul>
      <paginate name="paginate-log" :list="logs" :per="3">
        <li v-for="log in paginated('paginate-log')">
          {{ log.id }}: {{ log.title }}
        </li>
      </paginate>
    </ul>
    <paginate-links for="paginate-log" class="pagination" :show-step-links="true"></paginate-links>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      logs: [],
      paginate: ['paginate-log']
    }
  }
}
</script>


import Vue from 'vue';

Vue.mixin({
  methods: {
    formatDateBrazilian(date) {
      if (!date) return '';
      return new Date(date).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
      });
    }
  }
});
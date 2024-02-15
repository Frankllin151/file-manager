// store.js
import { defineStore } from 'pinia';

export const useStore = defineStore('app', {
  state: () => ({
    selectedFolderId: null,
  }),
  actions: {
    updateSelectedFolderId(folderId) {
      this.selectedFolderId = folderId;
    },
  },
});

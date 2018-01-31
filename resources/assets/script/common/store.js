import store from 'store2'

$.extend({
  store: {
    get (...arg) {
      return store(...arg)
    },
    set (...arg) {
      store(...arg)
    },
    has (key) {
      return store.has(key)
    },
    remove (key) {
      return store.remove(key)
    },
    clear () {
      store.clear()
    },
    array: {
      get (key) {
        return $.store.get(key) || []
      },
      set (key, data) {
        let collect = this.get(key)
        collect.push(data)
        $.store.set(key, collect)
      },
      remove (key, id, field = 'id') {
        let collect = this.get(key)
        $.store.set(key, collect.filter(res => res[field] !== id))
      },
      has (key, id, field = 'id') {
        let collect = this.get(key)
        return collect.some(res => res[field] === id)
      },
      toggle (key, data, field = 'id') {
        let collect = this.get(key)
        
        if (this.has(key, data.id, field)) {
          this.remove(key, data.id, field)
          return false
        } else {
          this.set(key, data)
          return true
        }
      }
    }
  }
})
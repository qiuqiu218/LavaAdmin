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
      set (key, data, field = 'id') {
        let id = 0
        if ($.isPlainObject(data)) {
          id = data.id
        } else {
          id = data
        }
        if (!this.has(key, id, field)) {
          let collect = this.get(key)
          collect.push(data)
          $.store.set(key, collect)
        }
      },
      remove (key, id, field = 'id') {
        let collect = this.get(key)
        $.store.set(key, collect.filter(res => {
          if ($.isPlainObject(res)) {
            return res[field] !== id
          } else {
            return res !== id
          }
        }))
      },
      has (key, id, field = 'id') {
        let collect = this.get(key)
        return collect.some(res => {
          if ($.isPlainObject(res)) {
            return res[field] === id
          } else {
            res === id
          }
        })
      },
      toggle (key, data, field = 'id') {
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
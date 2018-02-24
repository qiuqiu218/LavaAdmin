$.fn.extend({
  editorImage () {
    let _this = $(this)
    let is_add_css = false
    let data = {
      width: '100%',
      name: '',
      link: ''
    }
    // 渲染image属性界面
    function renderImageAttr () {
      $("#imageAttr").remove()
      
      let imageAttr = $(`
        <div id="imageAttr" class="layui-form d-padding-10">
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">宽度</label>
              <div class="layui-input-inline" style="width: 50px">
                <input type="text" name="width" class="layui-input" value="${data.width}">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">描述</label>
              <div class="layui-input-inline" style="width: 100px">
                <input type="text" name="name" class="layui-input" value="${data.name}">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">链接</label>
              <div class="layui-input-inline" style="width: 150px">
                <input type="text" name="link" class="layui-input" value="${data.link}">
              </div>
            </div>
            <div class="layui-inline">
              <div class="layui-input-inline">
                <button type="button" class="layui-btn layui-btn-xs">确定</button>
              </div>
            </div>
          </div>
        </div>
      `)

      imageAttr.find('button').on('click', function () {
        _this.attr({
          'width': imageAttr.find('input[name="width"]').val(),
          'alt': imageAttr.find('input[name="name"]').val()
        })
        let link = imageAttr.find('input[name="link"]').val()
        if (_this.parent().get(0).tagName === 'A') {
          if (link) {
            _this.parent().attr('href', link)
          } else {
            _this.parent().replaceWith(_this)
          }
        } else {
          if (link) {
            _this.wrap('<a href="'+ link +'"></a>')
          }
        }
        imageAttr.remove()
      })

      _this.parents('.w-e-text-container').append(imageAttr)
    }

    function getImageAttr () {
      data.width = _this.attr('width')
      data.name = _this.attr('alt')
      data.link = ''
      if (_this.parent().get(0).tagName === 'A') {
        data.link = _this.parent().attr('href')
      }
    }

    function initCss () {
      if (is_add_css) return
      let inlinecss = `
                  #imageAttr {background: #F1F1F1; position: absolute; bottom: 0; left: 0; right: 0}
                  #imageAttr .layui-inline {margin: 0}
                  #imageAttr .layui-form-label, #imageAttr .layui-form-item .layui-input-inline {width: auto}
                  #imageAttr .layui-input-inline {margin: 0}
                  #imageAttr .layui-form-label {padding: 4px 10px; height: 28px}
                  #imageAttr .layui-input {height: 28px; padding-left: 5px}
                  #imageAttr .layui-btn-xs {padding: 0 5px}
                `;
      // 将 css 代码添加到 <style> 中
      let style = document.createElement('style');
      style.type = 'text/css';
      style.innerHTML = inlinecss;
      document.getElementsByTagName('HEAD').item(0).appendChild(style);
    }

    return {
      onEdit () {
        initCss()
        getImageAttr()
        renderImageAttr()
      },
      offEdit () {
        $("#imageAttr").remove()
      }
    }
  }
})
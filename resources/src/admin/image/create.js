import {getUrlParam} from '_assets/script/tools/other'

let listView = $('#listView')
let uploadListIns = layui.upload.render({
  elem: '.image',
  url: '/admin/image',
  data: {
    model: getUrlParam('model'),
    info_id: getUrlParam('info_id'),
    mark: $('input[name="mark"]', window.parent.document).val() || '',
    _token: $('meta[name="csrf-token"]').attr('content')
  },
  accept: 'images',
  auto: false,
  bindAction: '#submit',
  field: 'img',
  multiple: true,
  choose (obj) {
    let files = this.files = obj.pushFile()

    obj.preview(function(index, file, result){
      let tr = $(['<tr id="upload-'+ index +'">',
                    '<td>'+ file.name +'</td>',
                    '<td>'+ (file.size/1014).toFixed(1) +'kb</td>',
                    '<td>等待上传</td>',
                    '<td>',
                      '<button class="layui-btn layui-btn-mini upload-reload layui-hide">重传</button>',
                      '<button class="layui-btn layui-btn-mini layui-btn-danger upload-delete">删除</button>',
                    '</td>',
                  '</tr>'].join(''))
        
      //单个重传
      tr.find('.upload-reload').on('click', function(){
        obj.upload(index, file);
      });
      
      //删除
      tr.find('.upload-delete').on('click', function(){
        delete files[index]; //删除对应的文件
        tr.remove();
        uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
      });
      
      listView.append(tr);
    });
  },
  done (res, index, upload) {
    if(res.status === 'success'){ //上传成功
      let tr = listView.find('tr#upload-'+ index)
      let tds = tr.children()
      tds.eq(2).html('<span style="color: #5FB878;">上传成功</span>');
      tds.eq(3).html(''); //清空操作
      return delete this.files[index]; //删除文件队列已经上传成功的文件
    }
    this.error(index, upload);
  },
  error (index, upload) {
    let tr = listView.find('tr#upload-'+ index)
    let tds = tr.children()
    tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
    tds.eq(3).find('.upload-reload').removeClass('layui-hide'); //显示重传
  }
})
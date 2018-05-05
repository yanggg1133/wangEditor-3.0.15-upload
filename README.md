#wangEditor是一款基于javascript和css开发的 Web富文本编辑器，有轻量、简洁、易用、开源免费等优点。
官网：www.wangeditor.com
文档：www.kancloud.cn/wangfupeng/wangeditor3/332599
源码：github.com/wangfupeng1988/wangEditor
下载链接：github.com/wangfupeng1988/wangEditor/releases

## 本次只是做了一个本地图片上传的实例
# 作者博客 http://www.91sheli.cn/blog 欢迎大家来一起讨论


wangEditor3 图片上传本地服务器
2017年12月28日 17:24:55
阅读数：417
wangEditor是一款基于javascript和css开发的 Web富文本编辑器，有轻量、简洁、易用、开源免费等优点。
官网：www.wangeditor.com
文档：www.kancloud.cn/wangfupeng/wangeditor3/332599
源码：github.com/wangfupeng1988/wangEditor
下载链接：github.com/wangfupeng1988/wangEditor/releases

 这个编译器虽然是个人维护的，但是本人还是感觉不错，没有像百度编译器那样繁重。

优点：作者一直有更新，并且有QQ群： 164999061，github，作者能及时的回答问题。有一点非常赞的一点，代码注释非常好。并且有区分开发和上线提示，并且判断Console日志输出

缺点：缺少各种demo，不过好在作者注释很详细

下边说下最近用到是遇到的问题，编译内容图片上传本地服务器上

下再好的源码后，找到test-uploadimg.html文件



注：此文件中引用的wangEditor.min.js文件位置是错误的，修改此文件的引入

然后在 页面上js  editor2.create()之前加入

editor2.customConfig.uploadImgServer = 'upload.php'
1、这个是配置本地图片上传的位置，加上这个后前台页面就会出现上传图片按钮



2、更改基本配置

默认限制图片大小是 5M

// 将图片大小限制为 3M
editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024
限制一次最多能传几张图片

默认为 10000 张（即不限制），需要限制可自己配置

// 限制一次最多上传 5 张图片
editor.customConfig.uploadImgMaxLength = 5
 自定义 fileName

上传图片时，可自定义filename，即在使用formdata.append(name, file)添加图片文件时，自定义第一个参数。

editor.customConfig.uploadFileName = 'yourFileName'
自定义 header

上传图片时刻自定义设置 header

editor.customConfig.uploadImgHeaders = {
    'Accept': 'text/x-json'
}
监听函数

可使用监听函数在上传图片的不同阶段做相应处理

editor.customConfig.uploadImgHooks = {
    before: function (xhr, editor, files) {
        // 图片上传之前触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件
        
        // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
        // return {
        //     prevent: true,
        //     msg: '放弃上传'
        // }
    },
    success: function (xhr, editor, result) {
        // 图片上传并返回结果，图片插入成功之后触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
    },
    fail: function (xhr, editor, result) {
        // 图片上传并返回结果，但图片插入错误时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
    },
    error: function (xhr, editor) {
        // 图片上传出错时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
    },
    timeout: function (xhr, editor) {
        // 图片上传超时时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
    },

    // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
    // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
    customInsert: function (insertImg, result, editor) {
        // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
        // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

        // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
       insertImg(result.data)

        // result 必须是一个 JSON 格式字符串！！！否则报错
    }
    }
}
3、 上传图片

    下边我们就来到坑边了,此处你会发现明明图片已经上传成功了，可是前台还是会显示上传失败



这个错误手册上没有明确的说



从这个地方我们会发现返回的数据可能有问题，按手册这个说法，我们这个地方返回的数据格式应该是

{errno:0,data:[...]}这样的数据（但是这个博主没有试，大家可以自行去试）我们用自定义插入图片

注意这个地方的返回数据是图片上传的路径

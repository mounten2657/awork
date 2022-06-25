<?php
return [
    '/inter/allow' => [
        'method' => 'POST',
        'params' => [
            'id' => 'A1B10731DB7786B2',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":[{"id":"00KHEMRDWZNJAJWYYV096VIM","identity":3,"nickname":"\\u6e38\\u5ba25dMblR","phone":"","status":1,"avatar":"","login_method":1,"server_time":1606658564,"access_token":"UVJSL0dlYmFSL3d5UHhDZ28xL2xxMUxOVVhsYlV0Z0NPaXdQNmxMSGFLSk4zeXh5WCtsVzBEREFVUUQzb1hoMQ=="},{"id":"00KHEMRDWZNJAJWYYV096VIM","identity":3,"nickname":"\\u6e38\\u5ba25dMblR","phone":"","status":1,"avatar":"","login_method":1,"server_time":1606658564,"access_token":"UVJSL0dlYmFSL3d5UHhDZ28xL2xxMUxOVVhsYlV0Z0NPaXdQNmxMSGFLSk4zeXh5WCtsVzBEREFVUUQzb1hoMQ=="}],"message":"OK"}',
    ],
    '/inter/logout' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/site/phone-login' => [
        'method' => 'POST',
        'params' => [
            'phone' => 'D8F3E623A91D70DC',
            'code' => '3D6512A77BF0BC26',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"00K5H1KO60NAEIXXDT1SPMMM","phone":"157****7560","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png","status":1,"special_signature":"\\u6211\\u662f\\u4e00\\u4e2a\\u7c89\\u5237\\u5320~","birthday":960336000,"gender":1,"description":"","province":0,"city":0,"industry":0,"job":1,"education":7,"created_at":1579197762,"login_method":1,"server_time":1606627751},"message":"OK"}',
    ],
    '/site/pwd-login' => [
        'method' => 'POST',
        'params' => [
            'phone' => '70EDF71FD18DEC92',
            'password' => '671C584C218C0806',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"00K5H1KO60NAEIXXDT1SPMMM","phone":"157****7560","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png","status":1,"special_signature":"\\u6211\\u662f\\u4e00\\u4e2a\\u7c89\\u5237\\u5320~","birthday":960336000,"gender":1,"description":"","province":0,"city":0,"industry":0,"job":1,"education":7,"created_at":1579197762,"login_method":1,"server_time":1606627751},"message":"OK"}',
    ],
    '/dynamic/del' => [
        'method' => 'POST',
        'params' => [
            'id' => '131F916D15E4A602',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/dynamic/get-detail' => [
        'method' => 'POST',
        'params' => [
            'id' => '524326420240EB1C',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"00KEFGC0YMS64RZ35SJRYJ2O","user_id":"00KA3D5KI0EM8X8S5MBNZO51","target_id":"00KEFGC1GPYEDTEXZCNNGCGB","target_type":1,"type":1,"is_deleted":0,"created_at":1598692662,"user":{"id":"00KA3D5KI0EM8X8S5MBNZO51","nickname":"\\u5343\\u5343","avatar":"bd3833c6d047c3e093bfac85395d305f.png"},"article":{"\\u3010\\u6ce8\\u610f\\u3011":"\\u6b64\\u8282\\u70b9\\u5728\\u3010\\u6587\\u7ae0\\u52a8\\u6001\\u3011\\u4e2d\\u624d\\u6709\\u503c\\uff0c\\u5426\\u5219\\u4e3a\\u7a7a\\u5bf9\\u8c61","id":"00KEFGC1GPYEDTEXZCNNGCGB","cover_url":"f5198d64e3cb83392f1e18c7d1070c25.jpg","title":"\\u7ea2\\u7816\\u7eff\\u74e6\\u5916\\u9ad8\\u697c\\u6797\\u7acb\\uff0c\\u662f\\u8c01\\u5e26\\u6211\\u7a7f\\u8d8a\\u65f6\\u7a7a\\uff1f","description":"\\u6e05\\u6668\\uff0c\\u6668\\u5149\\u71b9\\u5fae\\uff0c\\u53e4\\u8001\\u7684\\u57ce\\u95e8\\u5728\\u8584\\u96fe\\u4e2d\\u5f71\\u5f71\\u7ef0\\u7ef0\\uff0c\\u800c\\u5929\\u5b89\\u95e8\\u5e7f\\u573a\\u4e0a\\uff0c\\u65e9\\u5df2\\u805a\\u96c6\\u4e86\\u4eba\\u7fa4\\uff0c\\u9759\\u9759\\u5730\\u7b49\\u5f85\\u7740\\u4e00\\u62b9\\u9c9c\\u8273\\u7684\\u7ea2\\u3002\\u8fd9\\u91cc\\u662f","is_deleted":0,"is_shield":0,"created_at":1598692662,"content":"\\u8fd9\\u662f\\u6587\\u7ae0\\u5185\\u5bb9"},"note":{"\\u3010\\u6ce8\\u610f\\u3011":"\\u6b64\\u8282\\u70b9\\u5728\\u3010\\u7b14\\u8bb0\\u52a8\\u6001\\u3011\\u4e2d\\u624d\\u6709\\u503c\\uff0c\\u5426\\u5219\\u4e3a\\u7a7a\\u5bf9\\u8c61","id":"00KFDD0DPC1LFYZUBPWFUFGD","user_id":"00K6R8NNVL4GVOGPIGQSPJN3","article_id":"00KCFV679OEOYZLPAUQCKZJX","is_choice":0,"is_deleted":0,"is_public":1,"is_shield":0,"created_at":1600742930,"content":"\\u4e0d\\u8fc7\\u8fd9\\u91cc\\u9762\\u4e0d\\u5305\\u62ec\\u7cd6\\u5206\\u9ad8\\u7684\\u6c34\\u679c\\uff0c\\u6bd4\\u5982\\u897f\\u74dc\\uff0c\\u5403\\u591a\\u4e86\\u4e00\\u6837\\u662f\\u4f1a\\u957f\\u80d6\\u7684","selected":"\\u6c34\\u679c\\u4e2d\\u6709\\u4e00\\u4e2a\\u6c34\\u5b57\\uff0c\\u987e\\u540d\\u601d\\u4e49\\uff0c\\u91cc\\u9762\\u6240\\u542b\\u6709\\u7684\\u6c34\\u5206\\u5f88\\u591a\\uff0c\\u5f88\\u591a\\u90fd\\u8fbe\\u5230\\u4e8690%\\u4ee5\\u4e0a\\u3002\\u9664\\u4e86\\u725b\\u6cb9\\u679c\\u3001\\u69b4\\u83b2\\u7b49\\u4e2a\\u522b\\u6c34\\u679c\\u4ee5\\u5916\\uff0c\\u5927\\u90e8\\u5206\\u6c34\\u679c\\u91cc\\u6240\\u542b\\u7684\\u8102\\u80aa\\u51e0\\u4e4e\\u53ef\\u4ee5\\u5ffd\\u7565\\u4e0d\\u8ba1\\uff0c\\u800c\\u8102\\u80aa\\u662f\\u4f9b\\u7ed9\\u80fd\\u91cf\\u7684\\u4e3b\\u8981\\u7269\\u8d28\\u4e4b\\u4e00\\u3002\\u56e0\\u6b64\\u589e\\u52a0\\u6c34\\u679c\\u8fd9\\u79cd\\u4f4e\\u80fd\\u91cf\\u5bc6\\u5ea6\\u7684\\u98df\\u7269\\uff0c\\u53d6\\u4ee3\\u5176\\u4ed6\\u9ad8\\u70ed\\u91cf\\u7684\\u52a0\\u5de5\\u7c7b\\u98df\\u7269\\uff0c\\u53ef\\u4ee5\\u663e\\u8457\\u51cf\\u5c11\\u70ed\\u91cf\\u6444\\u5165\\uff0c\\u6709\\u6548\\u5b9e\\u73b0\\u80fd\\u91cf\\u8d1f\\u5e73\\u8861\\uff0c\\u51cf\\u5c11\\u8102\\u80aa\\u7ec4\\u7ec7\\u751f\\u6210\\uff0c\\u4ece\\u800c\\u6709\\u5229\\u4e8e\\u63a7\\u5236\\u4f53\\u91cd\\u3002","article":{"id":"00KCFV679OEOYZLPAUQCKZJX","cover_url":"a8c95f0208256a1cdd5f3ede1256e572.jpg","title":"\\u897f\\u74dc\\u3001\\u8354\\u679d\\u3001\\u69b4\\u83b2\\u2026\\u2026\\u5230\\u5e95\\u662f\\u51cf\\u80a5\\u4f73\\u54c1\\u8fd8\\u662f\\u589e\\u80a5\\u5229\\u5668\\uff1f","description":"\\u6c34\\u679c\\u8425\\u517b\\u5bc6\\u5ea6\\u9ad8\\uff0c\\u70ed\\u91cf\\u76f8\\u5bf9\\u8f83\\u4f4e\\uff0c\\u4e14\\u5bcc\\u542b\\u81b3\\u98df\\u7ea4\\u7ef4\\u3002\\u6709\\u7814\\u7a76\\u53d1\\u73b0\\u591a\\u5403\\u6c34\\u679c\\u4e0e\\u4f53\\u91cd\\u964d\\u4f4e\\u76f8\\u5173\\uff0c\\u539f\\u56e0\\u662f\\u5403\\u6c34\\u679c\\u6709\\u5229\\u4e8e\\u51cf\\u5c11\\u603b\\u80fd\\u91cf","is_deleted":0,"is_shield":0,"created_at":1594364065},"count":{"collect":0,"like":0,"comment":0}}},"message":"OK"}',
    ],
    '/share/upload' => [
        'method' => 'POST',
        'params' => [
            'target_type' => 'D144DEF28352DCF3',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"result":"1.jpg"},"message":"OK"}',
    ],
    '/search/article' => [
        'method' => 'POST',
        'params' => [
            'keywords_article' => '93C217C6F853F7E8',
            'last_id' => 'AF7F6363952FE762',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":false,"list":[{"id":"00KHZ79WZYNM3ISK8HMNO6TP","cover_url":"","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_deleted":0,"is_shield":0,"created_at":1606417117,"original":{"author_name":"\\u9ea6\\u5927\\u4eba","from":7,"time":1597498069},"count":{"collect":2,"note":1}}]},"message":"OK"}',
    ],
    '/search/user' => [
        'method' => 'POST',
        'params' => [
            'keywords_user' => '8C101FD2C65F581D',
            'last_id' => 'FBEA1D2D991A6E05',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":false,"list":[{"id":"00K5M5AQKM1YGHAQ11F4DVJZ","nickname":"\\u9648\\u80fd","avatar":"d3c829ef6cf628f0b8f39184eda76d75.png","special_signature":"\\u9762\\u5bf9\\u73b0\\u5b9e\\uff0c\\u6781\\u5ea6\\u5f00\\u653e\\uff0c\\u4e0e\\u4eba\\u4e3a\\u5584\\uff0c\\u4e0d\\u4e22\\u6389\\u521d\\u5fc3\\u548c\\u81ea\\u5df1\\uff01"}]},"message":"OK"}',
    ],
    '/message/clean' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/message/comment-send' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":6,"page":1,"page_size":2,"list":[{"id":5,"created_at":1597198306,"main":{"id":"00KDNW0H4Q0USZ8I4PB60BV9","target_type":4,"content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u8bc4\\u8bba","user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"ff56248a614b537781b7ff3cd4b3ad84.jpg"}},"child":{"id":"00KDNW6BWCYCHFITS38CXZGQ","content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u56de\\u590d","target_type":3,"user":{"id":"00K5HIY7S5QLRA0HE8DYIL0Y","nickname":"\\u7267\\u7f8a\\u4eba\\u5c0f\\u96f7","avatar":"270871d1be5127f1e4a6040550c32bf7.png"}},"target":{"id":"00KDFJW207WS7X8HP8ZN04GM","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","target_type":2,"article":{"id":"00KBZWSFY0JP7KPMYMJKX9STCKBZWSG0K","title":"\\u5bf9\\u4e0d\\u8d77\\uff0c\\u516c\\u53f8\\u4e0d\\u9700\\u8981\\u8fd9\\u79cd\\u201c\\u9ad8\\u60c5\\u5546\\u201d\\u5458\\u5de5","cover_url":"3f20d12d019d4ccc686b2f417ee10e46.jpg","description":"\\u6587\\u7ae0\\u6458\\u8981"}}},{"id":6,"created_at":1597198313,"main":{"id":"00KDNW0H4Q0USZ8I4PB60BV9","target_type":4,"content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u8bc4\\u8bba","user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"ff56248a614b537781b7ff3cd4b3ad84.jpg"}},"child":{"id":"00KDNW6BWCYCHFITS38CXZGQ","content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u56de\\u590d\\u7684\\u56de\\u590d","target_type":4,"user":{"id":"00K5L1KOTNVFQYGG6EZ0E13Z","nickname":"\\u5f20\\u5b97\\u826f","avatar":"7bbd7428d04b0b8b52e1062a9cb990ba.png"}},"target":{"id":"00KDFJW207WS7X8HP8ZN04GM","target_type":2,"content":"\\u7b14\\u8bb0\\u5185\\u5bb9","article":{"id":"00KBZWSFY0JP7KPMYMJKX9STCKBZWSG0K","title":"\\u5bf9\\u4e0d\\u8d77\\uff0c\\u516c\\u53f8\\u4e0d\\u9700\\u8981\\u8fd9\\u79cd\\u201c\\u9ad8\\u60c5\\u5546\\u201d\\u5458\\u5de5","cover_url":"3f20d12d019d4ccc686b2f417ee10e46.jpg","description":"\\u6587\\u7ae0\\u6458\\u8981"}}}]},"message":"OK"}',
    ],
    '/message/comment-receive' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":6,"page":1,"page_size":2,"list":[{"id":5,"created_at":1597198306,"main":{"id":"00KDNW0H4Q0USZ8I4PB60BV9","target_type":4,"content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u8bc4\\u8bba","user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"ff56248a614b537781b7ff3cd4b3ad84.jpg"}},"child":{"id":"00KDNW6BWCYCHFITS38CXZGQ","content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u56de\\u590d","target_type":3,"user":{"id":"00K5HIY7S5QLRA0HE8DYIL0Y","nickname":"\\u7267\\u7f8a\\u4eba\\u5c0f\\u96f7","avatar":"270871d1be5127f1e4a6040550c32bf7.png"}},"target":{"id":"00KDFJW207WS7X8HP8ZN04GM","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","target_type":2,"article":{"id":"00KBZWSFY0JP7KPMYMJKX9STCKBZWSG0K","title":"\\u5bf9\\u4e0d\\u8d77\\uff0c\\u516c\\u53f8\\u4e0d\\u9700\\u8981\\u8fd9\\u79cd\\u201c\\u9ad8\\u60c5\\u5546\\u201d\\u5458\\u5de5","cover_url":"3f20d12d019d4ccc686b2f417ee10e46.jpg","description":"\\u6587\\u7ae0\\u6458\\u8981"}}},{"id":6,"created_at":1597198313,"main":{"id":"00KDNW0H4Q0USZ8I4PB60BV9","target_type":4,"content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u7684\\u8bc4\\u8bba","user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"ff56248a614b537781b7ff3cd4b3ad84.jpg"}},"child":{"id":"00KDNW6BWCYCHFITS38CXZGQ","content":"\\u8fd9\\u662f\\u7b14\\u8bb0\\u56de\\u590d\\u7684\\u56de\\u590d","target_type":4,"user":{"id":"00K5L1KOTNVFQYGG6EZ0E13Z","nickname":"\\u5f20\\u5b97\\u826f","avatar":"7bbd7428d04b0b8b52e1062a9cb990ba.png"}},"target":{"id":"00KDFJW207WS7X8HP8ZN04GM","target_type":2,"content":"\\u7b14\\u8bb0\\u5185\\u5bb9","article":{"id":"00KBZWSFY0JP7KPMYMJKX9STCKBZWSG0K","title":"\\u5bf9\\u4e0d\\u8d77\\uff0c\\u516c\\u53f8\\u4e0d\\u9700\\u8981\\u8fd9\\u79cd\\u201c\\u9ad8\\u60c5\\u5546\\u201d\\u5458\\u5de5","cover_url":"3f20d12d019d4ccc686b2f417ee10e46.jpg","description":"\\u6587\\u7ae0\\u6458\\u8981"}}}]},"message":"OK"}',
    ],
    '/message/like' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":6,"page":1,"page_size":2,"list":[{"id":382,"created_at":1605677998,"main":{"target_type":2},"child":{"id":"00KF3COB6DYZFZ0RV2R61Q23","target_type":2,"content":"\\u7b14\\u8bb0\\u5185\\u5bb9","is_fail":false,"article":{"id":"00KDBT47KI7EMIYZQAHZJN26","target_type":1,"cover_url":"5aec4dc84bb149aeb2b35bc7fd305571.jpg","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_fail":false}}},{"id":383,"created_at":1605682371,"main":{"target_type":5},"child":{"id":"00KHLTTFBZ5PJZHRCRWXUFBD","target_type":1,"cover_url":"d7f52258c213e5cdd1adee1172662aa4.jpg","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_fail":false}}]},"message":"OK"}',
    ],
    '/message/announce' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":4,"page":1,"page_size":20,"list":[{"id":1,"title":"\\u7cfb\\u7edf\\u6d88\\u606f\\u6807\\u9898","content":{"html":"\\u516c\\u544a\\u5185\\u5bb9","operating":"\\u64cd\\u4f5c"},"created_at":1597112552}]},"message":"OK"}',
    ],
    '/message/unread' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"comment":8,"like":99,"announce":109},"message":"OK"}',
    ],
    '/quick/preview' => [
        'method' => 'POST',
        'params' => [
            'url' => '59A5ABC5BD336F25',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c"},"message":"OK"}',
    ],
    '/home/collect-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => 'E1CC09102F1DD583',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":2,"page_size":20,"page":1,"list":[{"id":"00KF3FHQABQOQSU8HQ1HM6ZJ","user_id":"00K6R8O5C6SPAIDSTALCF5GJ","article_id":"00KDTRSSL6RF5UF49UH0OFYK","is_choice":0,"is_deleted":0,"is_public":1,"is_shield":0,"created_at":1606790559,"target_type":2,"content":"\\u53ef\\u60dc\\u8fd1\\u6bb5\\u65f6\\u95f4\\u5370\\u5ea6\\u7684\\u79cd\\u79cd\\u884c\\u4e3a\\u5145\\u5206\\u53cd\\u6620\\u4e86\\u4ed6\\u4eec\\u5e76\\u6ca1\\u6709\\u8fd9\\u79cd\\u610f\\u8bc6","selected":"\\u5370\\u5ea6\\u653f\\u5ba2\\u8981\\u653e\\u4e0b\\u653f\\u6cbb\\u6210\\u89c1\\u548c\\u5730\\u7f18\\u91ce\\u5fc3\\uff0c\\u5fc3\\u5e73\\u6c14\\u548c\\u4e0e\\u4e2d\\u56fd\\u4eba\\u505a\\u751f\\u610f\\u3002\\u4e2d\\u56fd\\u4f01\\u4e1a\\u5230\\u5370\\u5ea6\\u6295\\u8d44\\uff0c\\u65e2\\u662f\\u4e3a\\u4e86\\u8d5a\\u94b1\\uff0c\\u4e5f\\u7ed9\\u5370\\u5ea6\\u4eba\\u6c11\\u9020\\u798f\\u3002\\u5bf9\\u4e24\\u56fd\\u5173\\u7cfb\\u6765\\u8bf4\\uff0c\\u6ca1\\u4ec0\\u4e48\\u6bd4\\u7ecf\\u6d4e\\u5f80\\u6765\\u66f4\\u91cd\\u8981\\u7684\\u7a33\\u5b9a\\u5668\\u4e86\\u3002","user":{"id":"00K6R8O5C6SPAIDSTALCF5GJ","nickname":"\\u8d75\\u60a6\\u7136","avatar":"b4314d6dec6690056a9c2fd017270335.jpg"},"article":{"id":"00KDTRSSL6RF5UF49UH0OFYK","cover_url":"de7d8870dad4b28065e43ceadcb1f3d3.jpg","title":"\\u4e2d\\u56fd\\u624b\\u673a\\u5728\\u5370\\u5ea6\\u4e3a\\u4f55\\u5b8c\\u80dc","description":"\\u6253\\u538b\\u4e2d\\u56fd\\u624b\\u673aAPP\\u4e4b\\u540e\\uff0c\\u5370\\u5ea6\\u6700\\u8fd1\\u5bf9\\u4e2d\\u56fd\\u4ea7\\u54c1\\u53c8\\u6709\\u6240\\u9488\\u5bf9\\u3002\\n8\\u67081\\u65e5\\uff0c\\u5370\\u5ea6\\u7535\\u5b50\\u548c\\u4fe1\\u606f\\u6280\\u672f\\u90e8\\u957f\\u8868\\u793a\\uff0c\\u5370\\u5ea6\\u5c06\\u51fa\\u53f06","is_deleted":0,"is_shield":0,"created_at":1597381716},"count":{"like":0,"collect":1},"collect_id":"00KI5DM2JPCT6GV8KJ2KSXLK"},{"id":"00KD3XBEWNSE5LLD0BEUATJK","cover_url":"e27f0f13c21ddbddc617ddbcc1dee195.jpg","title":"\\u4e2d\\u56fd\\u5f0f\\u5bb6\\u5ead\\u6559\\u80b2\\uff1a\\u5b69\\u5b50\\u4e0d\\u52aa\\u529b\\uff0c\\u7238\\u7238\\u4e0d\\u51fa\\u529b\\uff0c\\u5988\\u5988\\u7528\\u86ee\\u529b\\uff0c\\u5230\\u5934\\u6765\\u5374\\u53ea\\u602a\\u5b69\\u5b50\\u662f\\u53db\\u9006...","description":"\\u7236\\u4eb2\\u4eec\\u6700\\u6839\\u672c\\u7684\\u7f3a\\u70b9\\u5728\\u4e8e\\u60f3\\u8981\\u81ea\\u5df1\\u7684\\u5b69\\u5b50\\u4e3a\\u81ea\\u5df1\\u4e89\\u5149\\u2014\\u2014\\u7f57\\u7d20\\u73b0\\u5728\\u7684\\u5bb6\\u957f\\u90fd\\u5f88\\u91cd\\u89c6\\u5b69\\u5b50\\u7684\\u6559\\u80b2\\u3002\\u4ece\\u5b69\\u5b503\\u5c81\\u5de6\\u53f3\\u5f00\\u59cb\\u5bb6\\u957f\\u5c31","is_deleted":0,"is_shield":0,"created_at":1606790554,"collect_id":"00KI5DLYNYLOCTB3X7WORDAJ","target_type":1}]},"message":"OK"}',
    ],
    '/home/package-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => 'A3898E8713A05CA2',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":false,"list":[{"id":"00KFNW99P017PBNZGEGGZU6Y","user_id":"00K5H1KO60NAEIXXDT1SPMMM","name":"\\u9ed8\\u8ba4\\u6536\\u85cf\\u5939","description":"","total":6,"is_default":1,"is_deleted":0,"is_public":1,"updated_at":1606572208},{"id":"00KHZ2RM1B0TSQDSQATGAEPA","user_id":"00K5H1KO60NAEIXXDT1SPMMM","name":"\\u79c1\\u5bc6\\u6536\\u85cf\\u5939","description":"","total":3,"is_default":1,"is_deleted":0,"is_public":0,"updated_at":1606468389}]},"message":"OK"}',
    ],
    '/quick/collect' => [
        'method' => 'POST',
        'params' => [
            'url' => '548CC1CF32C3B810',
            'package_id' => 'E84CAA99F50DEC7D',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c"},"message":"OK"}',
    ],
    '/home/note-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => '8226EEDBE499D0FC',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":false,"list":[{"id":"00KHZCII8WDJR6RBTOCIL0ZS","user_id":"00K5H1KO60NAEIXXDT1SPMMM","article_id":"00KGSTUO1LNFEFGDA5AIYMBX","is_choice":0,"is_deleted":0,"is_public":1,"is_shield":0,"created_at":1606425916,"start_index":12942,"end_index":13301,"content":"\\u7b14\\u8bb0\\u5185\\u5bb9","selected":"\\u6587\\u7ae0\\u8282\\u9009","is_like":false,"is_collect":false,"user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png"},"article":{"id":"00KGSTUO1LNFEFGDA5AIYMBX","cover_url":"6f7822d1a89860a5b85b16ef3154b462.jpg","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_deleted":0,"is_shield":0,"created_at":1603854991},"count":{"comment":0,"like":0,"collect":0}}]},"message":"OK"}',
    ],
    '/square/attention-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => 'A0B75EACDCCAFE25',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"has_more":true,"list":[{"id":"24\\u4f4d\\u52a8\\u6001ID","created_at":1604632694,"target_type":1,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","avatar":"default.png","nickname":"\\u542c\\u541b031233"},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","is_deleted":0,"count":{"like":0,"collect":0}},"note":{"id":"24\\u4f4d\\u7b14\\u8bb0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","type":"\\u7b14\\u8bb0\\u7c7b\\u578b\\uff0c1\\u6587\\u7ae0\\u7b14\\u8bb0\\uff0c2\\u6587\\u7ae0\\u5212\\u7ebf\\u7b14\\u8bb0\\uff0c3\\u6587\\u672c\\u7c7b\\u7b14\\u8bb0","selected":"\\u6587\\u7ae0\\u8282\\u9009\\u5185\\u5bb9\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","start_index":1,"end_index":2,"article":{"id":"24\\u4f4d\\u6587\\u5b57ID","title":"\\u6587\\u5b57\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981","is_deleted":0}}}]},"message":"OK"}',
    ],
    '/square/recommend-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => 'BF9F7A6C3E62266F',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"has_more":true,"list":[{"id":"24\\u4f4d\\u52a8\\u6001ID","created_at":1604632694,"target_type":1,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","avatar":"default.png","nickname":"\\u542c\\u541b031233"},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","is_deleted":0,"count":{"like":0,"collect":0}},"note":{"id":"24\\u4f4d\\u7b14\\u8bb0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","type":"\\u7b14\\u8bb0\\u7c7b\\u578b\\uff0c1\\u6587\\u7ae0\\u7b14\\u8bb0\\uff0c2\\u6587\\u7ae0\\u5212\\u7ebf\\u7b14\\u8bb0\\uff0c3\\u6587\\u672c\\u7c7b\\u7b14\\u8bb0","selected":"\\u6587\\u7ae0\\u8282\\u9009\\u5185\\u5bb9\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","start_index":1,"end_index":2,"article":{"id":"24\\u4f4d\\u6587\\u5b57ID","title":"\\u6587\\u5b57\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981","is_deleted":0}}}]},"message":"OK"}',
    ],
    '/pro/list' => [
        'method' => 'POST',
        'params' => [
            'category_id' => 'D3EAC374EC4F820B',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":10,"page":1,"page_size":5,"list":[{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png","description":"\\u674e\\u5929\\u5176\\u7b80\\u4ecb","qrcode":"","created_at":1606616678,"phone":"15715867560","category":[{"id":1,"name":"\\u5fc3\\u7406","member_count":1,"weight":9,"status":1,"is_deleted":0,"created_at":1604374196},{"id":2,"name":"\\u804c\\u4e1a\\u53d1\\u5c55","member_count":1,"weight":8,"status":1,"is_deleted":0,"created_at":1604374196}]}]},"message":"OK"}',
    ],
    '/pro/recommend-list' => [
        'method' => 'POST',
        'params' => [
            'page' => '5824534AE449D5E4',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"24\\u4f4d\\u667a\\u56ca\\u56e2ID","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png","nickname":"\\u667a\\u56ca\\u56e2\\u6635\\u79f0","description":"\\u667a\\u56ca\\u56e2\\u7b80\\u4ecb","qrcode":"\\u5fae\\u4fe1\\u4e8c\\u7ef4\\u7801\\u56fe\\u7247","category":{"id":1,"name":"\\u667a\\u56ca\\u56e2\\u5206\\u7c7b\\u540d\\u79f0"}}]},"message":"OK"}',
    ],
    '/pro-category/list' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":8,"page_size":20,"page":1,"list":[{"id":2,"name":"\\u804c\\u4e1a\\u53d1\\u5c55"}]},"message":"OK"}',
    ],
    '/article/get-detail' => [
        'method' => 'POST',
        'params' => [
            'id' => '1202217367F82C4D',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"00KHZ8JNDGFMN3CUSTFSY6WW","cover_url":"676d6f4a2e7ccf9534fbf07ba1776a36.jpeg","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_deleted":0,"is_shield":0,"created_at":1606419251,"original_url":"https:\\/\\/mp.weixin.qq.com\\/s\\/PybM-v4_-O2Obw_5u53uow","content":"\\u6587\\u7ae0\\u5185\\u5bb9","original":{"author_name":"","from":"\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7","time":"1606205585","url":"https:\\/\\/mp.weixin.qq.com\\/s\\/PybM-v4_-O2Obw_5u53uow"},"count":{"collect":1,"note":0},"note_list":[{"id":"24\\u4f4d\\u7b14\\u8bb0ID","start_index":"1","end_index":"2"}],"is_collect":0},"message":"OK"}',
    ],
    '/note/line-list' => [
        'method' => 'POST',
        'params' => [
            'start_index' => 'F1C8ECE8893DB6ED',
            'end_index' => 'ABA9909D55817313',
            'order' => 'F41FBF476953F3F5',
            'last_id' => '4BAF8346D32C7F5A',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":false,"list":[{"id":"00KI11C79HFZO4XLP9JK8O82","user_id":"00K5H1KO60NAEIXXDT1SPMMM","article_id":"00KI01SU497ZFJWUVUULMX53","is_choice":0,"is_deleted":0,"is_public":1,"is_shield":0,"created_at":1606528079,"start_index":2427,"end_index":2501,"content":"123","selected":"\\u6587\\u7ae0\\u8282\\u9009","is_like":false,"is_collect":false,"user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png"},"article":{"id":"00KI01SU497ZFJWUVUULMX53","cover_url":"","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_deleted":0,"is_shield":0,"created_at":1606468389},"count":{"comment":0,"like":0,"collect":0}}]},"message":"OK"}',
    ],
    '/note/article-list' => [
        'method' => 'POST',
        'params' => [
            'article_id' => '71E4AE8DC2B8C8F8',
            'tab' => 'A3CB99EA82E86BF6',
            'order' => '0FE18CBC3EA2BC20',
            'last_id' => '771A5FF744F71DE3',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":40,"list":[{"id":"24\\u4f4d\\u6587\\u7ae0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","selected":"\\u6587\\u7ae0\\u8282\\u9009","start_index":3,"end_index":5,"is_fail":0,"is_public":2,"is_collect":false,"is_like":false,"created_at":1592910533,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"collect":1,"like":0,"comment":0},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe","description":"\\u6587\\u7ae0\\u6458\\u8981"}}]},"message":"OK"}',
    ],
    '/note/add-line' => [
        'method' => 'POST',
        'params' => [
            'article_id' => '542B068C4A70D3F7',
            'content' => '479112326A4F5F57',
            'selected' => 'F7807CE169CA2644',
            'start_index' => '445AC2C43DA61956',
            'end_index' => '7BCE776B9C7C324C',
            'is_public' => 'EF2CCEDD5EE681DA',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u7b14\\u8bb0ID","start_index":3,"end_index":5},"message":"OK"}',
    ],
    '/note/add' => [
        'method' => 'POST',
        'params' => [
            'article_id' => '34799AC564657D74',
            'content' => 'BCD171A97955A9CC',
            'is_public' => 'C280125F841B1852',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u7b14\\u8bb0ID"},"message":"OK"}',
    ],
    '/note/del' => [
        'method' => 'POST',
        'params' => [
            'id' => 'B410E5FF50A7B4A4',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/note/edit' => [
        'method' => 'POST',
        'params' => [
            'id' => 'AAFBA5BC0B9E41E1',
            'is_public' => 'F16BB3648F71D8CF',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/note/get-detail' => [
        'method' => 'POST',
        'params' => [
            'id' => '2528587434B0BAF6',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"00KI11C79HFZO4XLP9JK8O82","user_id":"00K5H1KO60NAEIXXDT1SPMMM","article_id":"00KI01SU497ZFJWUVUULMX53","is_choice":0,"is_deleted":0,"is_public":1,"is_shield":0,"created_at":1606528079,"content":"123","selected":"\\u6587\\u7ae0\\u8282\\u9009","user":{"id":"00K5H1KO60NAEIXXDT1SPMMM","nickname":"\\u7c89\\u5237\\u5320","avatar":"2e40f4e2d75d6db4e2deba6dc58f1105.png"},"article":{"id":"00KI01SU497ZFJWUVUULMX53","cover_url":"","title":"\\u6587\\u7ae0\\u6807\\u9898","description":"\\u6587\\u7ae0\\u63cf\\u8ff0","is_deleted":0,"is_shield":0,"created_at":1606468389},"count":{"collect":0,"like":0,"comment":0},"is_like":0,"is_collect":0},"message":"OK"}',
    ],
    '/comment/list' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '24725B085B532374',
            'target_type' => '02E99371B4E6502E',
            'order' => '333D4A2759A9EEB4',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":10,"page":1,"list":[{"id":"24\\u4f4d\\u8bc4\\u8bbaID","content":"\\u8bc4\\u8bba\\u5185\\u5bb9","is_deleted":0,"is_like":false,"created_at":1599198791,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"reply":0,"like":0},"reply":{"total_count":0,"page_size":5,"page":1,"list":[{"id":"24\\u4f4d\\u56de\\u590dID","content":"\\u56de\\u590d\\u5185\\u5bb9","is_deleted":0,"is_like":false,"created_at":1599198791,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"to_user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"reply":0,"like":0}}]}}]},"message":"OK"}',
    ],
    '/comment/del' => [
        'method' => 'POST',
        'params' => [
            'id' => 'E140FB398B386D1E',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/comment/add' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '1CECDBE8EA49424C',
            'target_type' => 'CC65B92A7EA17AFE',
            'content' => '9581B138BC97283C',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u8bc4\\u8bbaID","content":"\\u8bc4\\u8bba\\u5185\\u5bb9","is_deleted":0,"is_like":false,"created_at":1599198791,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"reply":0,"like":0}},"message":"OK"}',
    ],
    '/reply/list' => [
        'method' => 'POST',
        'params' => [
            'comment_id' => 'ED855763012FEDCF',
            'page' => '692091DB29002EA6',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":10,"page":1,"list":[{"id":"24\\u4f4d\\u56de\\u590dID","content":"\\u56de\\u590d\\u5185\\u5bb9","is_deleted":0,"is_like":false,"created_at":1599198791,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"to_user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"reply":0,"like":0}}]},"message":"OK"}',
    ],
    '/reply/del' => [
        'method' => 'POST',
        'params' => [
            'id' => '1E5C84A7E73F631A',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/reply/add' => [
        'method' => 'POST',
        'params' => [
            'parent_id' => '0DB197160731D5B8',
            'content' => 'D8871107AC1F2B94',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u56de\\u590dID","content":"\\u56de\\u590d\\u5185\\u5bb9","is_deleted":0,"is_like":false,"created_at":1599198791,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"to_user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"reply":0,"like":0}},"message":"OK"}',
    ],
    '/package/more-list' => [
        'method' => 'POST',
        'params' => [
            'id' => '77341CB0FC482B34',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"00K6BQZ99T1IZB9ZXO0IUSZX","user_id":"00K6BQZ99T1IZB9ZXO0IUSZX","name":"\\u9ed8\\u8ba4\\u6536\\u85cf\\u5939","description":"","total":7,"is_default":1,"is_deleted":0,"is_public":1,"updated_at":1605189506}]},"message":"OK"}',
    ],
    '/package/target-list' => [
        'method' => 'POST',
        'params' => [
            'package_id' => '47368D35E0FB7FAA',
            'tab_type' => 'all',
            'page_size' => '3',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":14,"page_size":3,"page":1,"list":[{"id":"00KC95OJSN7YUKOAMNANOOKG","cover_url":"b32caaecb7a14e9b5dd119d2569325c8.jpg","title":"如何用运营思维找到男朋友","description":"🔼点击上方蓝字关注我，和奥利一起进步互联网商业其实就是三个核心词：产品、流量、转化率。也就是产品的比拼、流量","is_deleted":0,"is_shield":0,"created_at":1594104659,"package_id":"00KEL6YTXKUZGAHBW7VGMDI7","collect_id":0,"target_type":1,"is_collect":false},{"id":"00KC5YNNAVUOAJILYSYCOM6J","cover_url":"568e90035aec7c9b9a96384c271d71e3.png","title":"Keep的背后，是无数人在薛定谔的健身","description":"不知道从什么时候开始，一股健身的浪潮席卷了我们……","is_deleted":0,"is_shield":0,"created_at":1594104541,"package_id":"00KEL6YTXKUZGAHBW7VGMDI7","collect_id":0,"target_type":1,"is_collect":false},{"id":"00KC5YI2WJHGTOMMPIMPVQ0M","cover_url":"e72ce83c9f86cc1159e09ceefd348429.jpg","title":"贾跃亭道歉背后：一封公开信再躲4年？承诺赔偿却没有一分钱真金白银","description":"贾跃亭虽然对股东作出了口头承诺，但对于乐视网来说，这28万散户却并不是其债权人。6月17日，乐视网发布澄清公","is_deleted":0,"is_shield":0,"created_at":1594104535,"package_id":"00KEL6YTXKUZGAHBW7VGMDI7","collect_id":0,"target_type":1,"is_collect":false}]},"message":"OK"}',
    ],
    '/package/list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => '171607ABA56047F6',
            'user_id' => '74F819898CA97333',
            'target_id' => 'AA990B5295303E7F',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"00K6BQZ99T1IZB9ZXO0IUSZX","user_id":"00K6BQZ99T1IZB9ZXO0IUSZX","name":"\\u9ed8\\u8ba4\\u6536\\u85cf\\u5939","description":"","total":7,"is_default":1,"is_deleted":0,"is_public":1,"updated_at":1605189506},{"id":"00KFNW99PUTOJA1JOAJSSUWE","user_id":"00K5H1KO60NAEIXXDT1SPMMM","name":"\\u9ed8\\u8ba4\\u6536\\u85cf\\u5939","description":"","total":8,"is_default":1,"is_deleted":0,"is_public":1,"updated_at":1605273623,"is_collect":0}]},"message":"OK"}',
    ],
    '/package/add' => [
        'method' => 'POST',
        'params' => [
            'name' => 'F11072E237189722',
            'description' => 'A18AC22DC025C57D',
            'is_public' => '1E603E90CA728094',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u6536\\u85cf\\u5939ID","name":"\\u8fd9\\u662f\\u67d0\\u7528\\u6237\\u65b0\\u5efa\\u7684\\u6536\\u85cf\\u5939","description":"\\u8fd9\\u662f\\u6536\\u85cf\\u5939\\u63cf\\u8ff0","total":"\\u5185\\u5bb9\\u6570","is_default":0,"is_public":1,"is_deleted":0},"message":"OK"}',
    ],
    '/package/del' => [
        'method' => 'POST',
        'params' => [
            'id' => 'D92F543C7AF566B9',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/package/edit' => [
        'method' => 'POST',
        'params' => [
            'id' => 'FC04903FA0539A1C',
            'name' => 'B7309308140FDF5D',
            'description' => '7BBE84122A861115',
            'is_public' => '8BC230C7D1818512',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u6536\\u85cf\\u5939ID","name":"\\u8fd9\\u662f\\u67d0\\u7528\\u6237\\u65b0\\u5efa\\u7684\\u6536\\u85cf\\u5939","description":"\\u8fd9\\u662f\\u6536\\u85cf\\u5939\\u63cf\\u8ff0","total":"\\u5185\\u5bb9\\u6570","is_default":0,"is_public":1,"is_deleted":0},"message":"OK"}',
    ],
    '/package/get-detail' => [
        'method' => 'POST',
        'params' => [
            'id' => 'C6644367E9BBE3E2',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u6536\\u85cf\\u5939ID","name":"\\u8fd9\\u662f\\u67d0\\u7528\\u6237\\u65b0\\u5efa\\u7684\\u6536\\u85cf\\u5939","description":"\\u8fd9\\u662f\\u6536\\u85cf\\u5939\\u63cf\\u8ff0","total":"\\u5185\\u5bb9\\u6570","is_default":0,"is_public":1,"is_deleted":0},"message":"OK"}',
    ],
    '/user/get-info' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u6635\\u79f0","avatar":"\\u5c01\\u9762\\u56fe","is_fail":"\\u662f\\u5426\\u5f02\\u5e38\\uff0c0\\u5426\\uff0c1\\u662f","created_at":1579197762,"count":{"note":1,"dynamic":1}},"message":"OK"}',
    ],
    '/user/unbind-wx' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/user/re-pwd' => [
        'method' => 'POST',
        'params' => [
            'code' => '2C8F4683C94168DF',
            'pwd' => '5F65C19BA138E968',
            'confirm_pwd' => '500F998EE22A0717',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/user/change-phone' => [
        'method' => 'POST',
        'params' => [
            'prev_code' => 'EA1B0AB0552A93C2',
            'code' => '56D6D7302B2F8214',
            'phone' => '20D124E504DD8678',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/user/get-detail' => [
        'method' => 'POST',
        'params' => [
            'id' => '54919627F2A0816E',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u6635\\u79f0","avatar":"\\u5c01\\u9762\\u56fe","identity":2,"phone":"\\u624b\\u673a\\u53f7\\uff0c\\u6ce8\\u610f\\u9690\\u85cf\\u4e2d\\u95f44\\u4f4d","is_fail":"\\u662f\\u5426\\u5f02\\u5e38\\uff0c0\\u5426\\uff0c1\\u662f","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173","wechat":{"nickname":"\\u5fae\\u4fe1\\u6635\\u79f0"},"created_at":1579197762,"gender":"\\u6027\\u522b\\uff0c1\\u7537\\uff0c2\\u5973\\uff0c3\\u4fdd\\u5bc6","birthday":0,"sign":"\\u4e2a\\u6027\\u7b7e\\u540d","education":"\\u5b66\\u5386","industry":"\\u884c\\u4e1a","job":"\\u804c\\u4e1a","count":{"note":1,"dynamic":1}},"message":"OK"}',
    ],
    '/user/edit' => [
        'method' => 'POST',
        'params' => [
            'id' => '6CCADC19F36EB0DD',
            'nickname' => 'B012BE92FCED1C67',
            'sign' => '9A0B6AF0ED880610',
            'gender' => '2CC31705DE53016C',
            'birthday' => '3D4EFEA6A7B22188',
            'country' => '148AF674A36DE931',
            'province' => 'C7752877C9D7555B',
            'city' => '2B8BC0B7FD659B22',
            'industry' => '104C35B754E7D527',
            'education' => '3C6CCB84006296CE',
            'job' => '6F128BCED70E4044',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/user/avatar' => [
        'method' => 'POST',
        'params' => [
            'id' => '7DFF4E754C4E2451',
            'file' => '481D355834D2C764',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"url":"1.jpg"},"message":"OK"}',
    ],
    '/user/dynamic-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => 'F8F6273053BC5BAF',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"24\\u4f4d\\u52a8\\u6001ID","created_at":1604632694,"target_type":1,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","avatar":"default.png","nickname":"\\u542c\\u541b031233"},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","is_fail":false,"count":{"like":0,"collect":0}},"note":{"id":"24\\u4f4d\\u7b14\\u8bb0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","type":"\\u7b14\\u8bb0\\u7c7b\\u578b\\uff0c1\\u6587\\u7ae0\\u7b14\\u8bb0\\uff0c2\\u6587\\u7ae0\\u5212\\u7ebf\\u7b14\\u8bb0\\uff0c3\\u6587\\u672c\\u7c7b\\u7b14\\u8bb0","selected":"\\u6587\\u7ae0\\u8282\\u9009\\u5185\\u5bb9\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","start_index":1,"end_index":2,"article":{"id":"24\\u4f4d\\u6587\\u5b57ID","title":"\\u6587\\u5b57\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981","is_fail":false}}}]},"message":"OK"}',
    ],
    '/user/note-list' => [
        'method' => 'POST',
        'params' => [
            'id' => 'F5132FD135DE38AE',
            'last_id' => '9273F791E3CDA4BE',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":40,"list":[{"id":"24\\u4f4d\\u6587\\u7ae0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","selected":"\\u6587\\u7ae0\\u8282\\u9009","start_index":3,"end_index":5,"is_fail":0,"is_public":2,"is_collect":false,"is_like":false,"created_at":1592910533,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"count":{"collect":1,"like":0,"comment":0},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe","description":"\\u6587\\u7ae0\\u6458\\u8981"}}]},"message":"OK"}',
    ],
    '/user/like-list' => [
        'method' => 'POST',
        'params' => [
            'id' => 'EA4A980F5707E66D',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"","created_at":1604632694,"target_type":1,"user":{"id":"24\\u4f4d\\u7528\\u6237ID","avatar":"default.png","nickname":"\\u542c\\u541b031233"},"article":{"id":"24\\u4f4d\\u6587\\u7ae0ID","title":"\\u6587\\u7ae0\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","is_fail":false,"count":{"like":0,"collect":0}},"note":{"id":"24\\u4f4d\\u7b14\\u8bb0ID","content":"\\u7b14\\u8bb0\\u5185\\u5bb9","type":"\\u7b14\\u8bb0\\u7c7b\\u578b\\uff0c1\\u6587\\u7ae0\\u7b14\\u8bb0\\uff0c2\\u6587\\u7ae0\\u5212\\u7ebf\\u7b14\\u8bb0\\uff0c3\\u6587\\u672c\\u7c7b\\u7b14\\u8bb0","selected":"\\u6587\\u7ae0\\u8282\\u9009\\u5185\\u5bb9\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","start_index":1,"end_index":2,"article":{"id":"24\\u4f4d\\u6587\\u5b57ID","title":"\\u6587\\u5b57\\u6807\\u9898","cover_url":"\\u5c01\\u9762\\u56fe\\uff0c\\u53ef\\u80fd\\u4f4d\\u7a7a\\u503c","description":"\\u6458\\u8981","is_fail":false}}}]},"message":"OK"}',
    ],
    '/user/package-list' => [
        'method' => 'POST',
        'params' => [
            'last_id' => '8010A0340D5FFF28',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"have_more":true,"list":[{"id":"24\\u4f4d\\u6536\\u85cf\\u5939ID","name":"\\u540d\\u79f0","description":"\\u6458\\u8981","total":"\\u5185\\u5bb9\\u6570","is_public":2,"is_default":2,"is_deleted":"\\u662f\\u5426\\u5220\\u9664\\uff0c0\\u6b63\\u5e38\\uff0c1\\u5220\\u9664","updated_at":1597200251}]},"message":"OK"}',
    ],
    '/agreement/get-detail' => [
        'method' => 'POST',
        'params' => [
            'route' => '7290D62CDC6CFDAF',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"title":"\\u8fd9\\u662f\\u534f\\u8bae\\u6807\\u9898","content":"\\u8fd9\\u662f\\u534f\\u8bae\\u5185\\u5bb9"},"message":"OK"}',
    ],
    '/report/add' => [
        'method' => 'POST',
        'params' => [
            'category_id' => 'C1450271B1490AA2',
            'target_id' => '242F7719B7112C02',
            'target_type' => 'DEE27BCF07A5D5C0',
            'content' => '78029582F52DE969',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/sms/send' => [
        'method' => 'POST',
        'params' => [
            'template' => '4387B1AD08BF68FF',
            'phone' => '91387CA72ABAE54D',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/relationship/add' => [
        'method' => 'POST',
        'params' => [
            'follow_id' => '972AD72468BBD124',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"attention_status":"\\u5173\\u6ce8\\u5173\\u7cfb\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"message":"OK"}',
    ],
    '/relationship/cancel' => [
        'method' => 'POST',
        'params' => [
            'follow_id' => 'B0CA204957A761DB',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"attention_status":"\\u5173\\u6ce8\\u5173\\u7cfb\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"},"message":"OK"}',
    ],
    '/relationship/following' => [
        'method' => 'POST',
        'params' => [
            'id' => '8064B81ADDACD2C6',
            'last_id' => '3FB6E5FB94065F1B',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"}]},"message":"OK"}',
    ],
    '/relationship/follower' => [
        'method' => 'POST',
        'params' => [
            'id' => 'BE88038952589322',
            'last_id' => 'C708850574FC4895',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":1,"page_size":20,"page":1,"list":[{"id":"24\\u4f4d\\u7528\\u6237ID","nickname":"\\u7528\\u6237\\u6635\\u79f0","avatar":"\\u5934\\u50cf","attention_status":"\\u5173\\u6ce8\\u72b6\\u6001\\uff0c1\\u6ca1\\u5173\\u6ce8\\uff0c2\\u5173\\u6ce8\\u4e86\\uff0c3\\u81ea\\u5df1\\uff0c4\\u4e92\\u5173"}]},"message":"OK"}',
    ],
    '/feedback/add' => [
        'method' => 'POST',
        'params' => [
            'content' => 'CBE255F8119AF4BC',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/industry/list' => [
        'method' => 'POST',
        'params' => [
            'page' => 'B762CB47E4C606E6',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":10,"page_size":20,"page":1,"list":[{"id":1,"name":"\\u5176\\u4ed6","is_other":1}]},"message":"OK"}',
    ],
    '/industry/add' => [
        'method' => 'POST',
        'params' => [
            'name' => 'CEA47ECDC060A85B',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/job/list' => [
        'method' => 'POST',
        'params' => [
        ],
        'mock' => '{"success":true,"statusCode":200,"result":{"total_count":10,"page_size":20,"page":1,"list":[{"id":1,"name":"\\u5176\\u4ed6"}]},"message":"OK"}',
    ],
    '/job/add' => [
        'method' => 'POST',
        'params' => [
            'name' => '2240DEF2E4B769DD',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/like/cancel' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '9C951EA4B321D2F4',
            'target_type' => '27BB8FACEB41E005',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/like/add' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '33E2B1E05AF376FB',
            'target_type' => '4F45E166A80FDCD1',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/collect/cancel' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '3078720EC593C622',
            'target_type' => 'D97F711694D7BAF4',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
    '/collect/add' => [
        'method' => 'POST',
        'params' => [
            'target_id' => '486763C1072AA8E9',
            'target_type' => 'A6E40C7A5636E07A',
            'package_id' => '994E326CA7A8C8FF',
        ],
        'mock' => '{"success":true,"statusCode":200,"result":true,"message":"OK"}',
    ],
];

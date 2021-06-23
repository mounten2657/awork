#chnnice_edu 数据字典

### 1.  `nice_crm2_campus` 校区资源分配表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| student_id | integer | 32 | NO | 0 | 资源ID | 
| city | smallint | 16 | NO | 0 | 分公司 | 
| campus | smallint | 16 | NO | 0 | 校区 | 
| assistant | integer | 32 | NO | 0 | 咨询师 | 
| follow_time | integer | 32 | NO | 0 | 最后跟进时间 | 
| next_time | integer | 32 | NO | 0 | 下次跟进时间 | 
| next_follow | smallint | 16 | NO | 0 |  -  | 
| follow_num | integer | 32 | NO | 0 | 跟进次数 | 
| distribution_time | integer | 32 | NO | 0 | 分配时间 | 
| campus_cuid | integer | 32 | NO | 0 | 资源在校区入库人 | 
| campus_ctime | integer | 32 | NO | 0 | 资源在校区入库时间 | 
| campus_source_from | smallint | 16 | NO | 0 | 资源在校区首次来源 | 
| campus_is_yx | smallint | 16 | NO | 2 | 是否是营销中心分配的 1是 2否 | 
| campus_status | smallint | 16 | NO | 0 | 校区资源状态 | 
| campus_source_child_from | smallint | 16 | NO | 0 | 校区资源来源子类 | 
| qy_time | integer | 32 | NO | 0 | 签约时间 | 
| qy_total | numeric | 10 | NO | 0 | 签约金额 | 
| qy_assistant | integer | 32 | NO | 0 | 签约咨询师 | 
| campus_is_sc | smallint | 16 | NO | 2 | 是否是市场部分配的 1是 2否 | 
| campus_sc_source_from | smallint | 16 | NO | 0 | 市场部来源(冗余字段，特殊需求字段) | 
| update_last_time | integer | 32 | NO | '' | 数据最后变更时间 | 
| area | integer | 32 | NO | 0 | 区域 | 
| tag_id | integer | 32 | NO | 0 | 标签ID | 
| zhuanjie_student_id | integer | 32 | NO | 0 | 转介学员 | 
| quick_follow_status | smallint | 16 | NO | 0 | 快捷跟进状态(1:正常 2:空号 3:停机 4:未接通 5:挂断/拒绝) | 
| promise_to_visit | smallint | 16 | NO | 0 | 承诺到访 1是 2否 | 
| promise_visit_date | integer | 32 | NO | 0 | 承诺到访日期 | 
| nuofan_date | smallint | 16 | NO | 0 | 诺访时间（8-10,10-12,13-15,15-17,18-20，20-22） | 

### 2.  `nice_crm2_campus_error_log` 资源录入失败原因记录表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' |  -  | 
| student_id | integer | 32 | NO | '' | 资源id | 
| ctime | integer | 32 | NO | '' | 创建时间 | 
| cuid | integer | 32 | NO | '' | 创建人 | 
| parent_mobile | character varying | 0 | NO | '' | 家长手机 | 
| remark | character varying | 0 | NO | '' | 备注 | 
| type | integer | 32 | NO | 1 | 类型(1:资源添加 2：到访登记) | 

### 3.  `nice_crm2_df` 到访表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| crm_student_id | integer | 32 | NO | 0 | 资源表student_id | 
| student_name | character varying | 0 | YES | '' | 学生姓名 | 
| parent_name | character varying | 0 | YES | '' | 家长姓名 | 
| parent_mobile | character varying | 0 | YES | '' | 家长电话 | 
| city | smallint | 16 | NO | 0 | 分公司 | 
| campus | smallint | 16 | NO | 0 | 校区 | 
| source_from | smallint | 16 | NO | 0 | 资源来源 | 
| grade | smallint | 16 | NO | 0 | 年级 | 
| gradelevel | smallint | 16 | NO | 0 | 年级段 | 
| is_first_time | smallint | 16 | NO | 0 | 是否首次到访 | 
| visit_type | smallint | 16 | NO | 0 | 到访目的 | 
| is_invitation | smallint | 16 | NO | 0 | 是否邀约 1是 2否 | 
| inviter | integer | 32 | NO | 0 | 邀约人 | 
| status | smallint | 16 | NO | 0 | 资源状态 | 
| remark | text | 0 | YES | '' | 备注 | 
| ctime | integer | 32 | NO | 0 | 创建时间 | 
| ymd | integer | 32 | NO | 0 | 创建时间 | 
| cuid | integer | 32 | NO | 0 | 创建者 | 
| mtime | integer | 32 | NO | 0 | 修改时间 | 
| muid | integer | 32 | NO | 0 | 修改者 | 
| visit_date | integer | 32 | NO | 0 | 到访时间 | 
| receiver | integer | 32 | NO | 0 | 接待人 | 
| source_from_20190214 | integer | 32 | NO | 0 | 2019年2月14日保存 | 
| school | character varying | 0 | NO | '' | 就读学校 | 
| crm_introducer | character varying | 0 | NO | '' | 介绍人 | 
| record_status | smallint | 16 | NO | 0 | 状态：1有效 2无效 | 
| teacher_name | text | 0 | YES | '' | 讲座老师 | 
| activity_id | integer | 32 | NO | 0 | 活动ID | 
| school_id | integer | 32 | NO | 0 | 学校id | 

### 4.  `nice_crm2_follow` 资源跟进表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| follow_id | integer | 32 | NO | '' | 回访ID | 
| student_id | integer | 32 | NO | 0 | 学生ID | 
| follow_way | smallint | 16 | NO | 0 | 回访方式 | 
| follow_time | integer | 32 | NO | 0 | 回访时间 | 
| next_follow | smallint | 16 | NO | 0 | 下次跟进 | 
| next_time | integer | 32 | NO | 0 | 下次跟进时间 | 
| remark | text | 0 | YES | '' | 回访反馈内容 | 
| status | smallint | 16 | NO | 0 | 资源状态 | 
| ctime | integer | 32 | NO | 0 | 创建时间 | 
| cuid | integer | 32 | NO | 0 | 回访人 | 
| mtime | integer | 32 | NO | 0 | 最后修改时间 | 
| muid | integer | 32 | NO | 0 | 修改者 | 
| service_type | smallint | 16 | NO | 0 | 下次服务类型 | 
| promise_to_visit | smallint | 16 | NO | 0 | 承诺到访 1是 0否 | 
| visit_type | smallint | 16 | NO | 0 | 到访类型 | 
| promise_visit_date | integer | 32 | NO | 0 | 承诺到访日期 | 
| ymd | integer | 32 | NO | 0 | 跟进时间 | 
| city | integer | 32 | NO | 0 | 分公司 | 
| campus | integer | 32 | NO | 0 | 校区 | 
| signing_intention | smallint | 16 | NO | 0 | 签单可能: 1大，2中，3一般 | 
| nuofan_date | smallint | 16 | NO | 0 | 诺访时间（8-10,10-12,13-15,15-17,18-20，20-22） | 
| is_audition | smallint | 16 | NO | 2 | 是否试听   1试听 | 
| audition_time | integer | 32 | NO | 0 | 试听时间 | 
| audition_teacher | character varying | 0 | NO | '' | 试听老师 | 
| audition_content | text | 0 | YES | '' | 试听内容 | 
| audition_complete | smallint | 16 | NO | 2 | 是否完成试听 | 
| audition_ymd | integer | 32 | NO | 0 | 试听时间 | 
| is_nuofan | smallint | 16 | NO | 2 | 是否诺访 | 
| nuofan_subject | character varying | 0 | NO | '' | 诺约科目 | 
| intention_course | smallint | 16 | NO | 0 | 意向课程 | 
| is_follow_status | smallint | 16 | NO | 1 | 是否有效跟进 | 
| promise_to_visit_status | smallint | 16 | NO | 2 | 是否确认到访 | 
| promise_to_visit_time | integer | 32 | NO | 0 | 确认到访时间 | 
| promise_to_visit_uid | integer | 32 | NO | 0 | 确认到访-确认人 | 
| type | smallint | 16 | NO | 1 | 类型 见缓存:follow_type | 
| option | text | 0 | NO | 0 | 选项 | 
| annex | text | 0 | YES | '' | 附件 | 
| annex_file_id | text | 0 | YES | '' | 附件ID | 

### 5.  `nice_crm2_log` 资源添加或导入日志
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| city | smallint | 16 | NO | 0 | 分公司 | 
| campus | smallint | 16 | NO | 0 | 校区 | 
| cuid | integer | 32 | NO | 0 | 操作人 | 
| ctime | integer | 32 | NO | 0 | 创建时间 | 
| ymd | integer | 32 | NO | 0 | 创建时间 | 
| student_id | integer | 32 | NO | 0 | 资源ID | 
| source_from | smallint | 16 | NO | 0 | 资源来源 | 
| crm_log_kind | smallint | 16 | NO | 0 | 1添加资源 2导入资源 | 
| source_from_20190214 | integer | 32 | NO | 0 | 2019年2月14日保存 | 
| old_campus | smallint | 16 | NO | 0 | 原校区 | 
| source_child_from | smallint | 16 | NO | 0 | 资源来源子类 | 
| old_assistant | integer | 32 | NO | 0 | 原咨询师（针对校区资源回收到校区资源池） | 

### 6.  `nice_crm2_resource_import_log` 资源导入明细
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| city | integer | 32 | NO | 0 | 分公司 | 
| campus | integer | 32 | NO | 0 | 校区 | 
| ctime | integer | 32 | NO | 0 | 入库时间 | 
| cuid | integer | 32 | NO | 0 | 添加者 | 
| source_from | smallint | 16 | NO | 0 | 资源来源 | 
| plan_id | integer | 32 | NO | 0 | 所属计划 | 
| activity_id | integer | 32 | NO | 0 | 所属活动 | 
| should_num | integer | 32 | NO | 0 | 应导入数 | 
| real_num | integer | 32 | NO | 0 | 实际导入数 | 
| fail_num | integer | 32 | NO | 0 | 导入失败数 | 
| fail_reason | ARRAY | 0 | YES | '' | 导入失败原因 | 
| ymd | integer | 32 | NO | 0 | 入库时间 | 
| repeat_num | integer | 32 | NO | 0 | 系统新增资源数 | 
| source_from_20190214 | integer | 32 | NO | 0 | 2019年2月14日保存 | 
| add_num | integer | 32 | NO | 0 | 系统新增资源数 | 
| campus_add_num | integer | 32 | NO | 0 | 本校区新增资源数 | 
| campus_repeat_num | integer | 32 | NO | 0 | 本校区重复导入数 | 
| status4_num | smallint | 16 | NO | 0 | 分公司市场部导入资源，存在已签约资源的数目，不可的条数 | 

### 7.  `nice_crm2_student` 资源表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| student_id | integer | 32 | NO | '' | 学生ID | 
| old_student_id | integer | 32 | NO | 0 | 老数据学生ID,后面废弃 | 
| student_name | character varying | 0 | YES | '' | 学生姓名 | 
| source_from | smallint | 16 | NO | 0 | 资源来源 | 
| mobile | character varying | 0 | YES | '' | 电话 | 
| parent_name | character varying | 0 | YES | '' | 家长姓名 | 
| parent_mobile | character varying | 0 | YES | '' | 家长电话 | 
| gender | smallint | 16 | NO | 0 | 性别 | 
| birthday | integer | 32 | NO | 0 | 生日 | 
| idcard | character varying | 0 | YES | '' | 身份证 | 
| province_id | integer | 32 | NO | 0 | 省 | 
| city_id | integer | 32 | NO | 0 | 市 | 
| region_id | integer | 32 | NO | 0 | 地区 | 
| province_name | character varying | 0 | YES | '' | 省 | 
| city_name | character varying | 0 | YES | '' | 市 | 
| region_name | character varying | 0 | YES | '' | 地区 | 
| address | character varying | 0 | YES | '' | 地址 | 
| school | character varying | 0 | YES | '' | 学校 | 
| gradelevel | smallint | 16 | NO | 0 | 年级段 | 
| grade | smallint | 16 | NO | 0 | 年级 | 
| class_name | character varying | 0 | YES | '' | 班级 | 
| city | smallint | 16 | NO | 0 | 分公司(作废) | 
| campus | smallint | 16 | NO | 0 | 校区(作废) | 
| assistant | smallint | 16 | NO | 0 | 咨询师(作废) | 
| follow_num | integer | 32 | NO | 0 | 跟进次数 | 
| next_follow | smallint | 16 | NO | 0 | 是否下次跟进 | 
| next_time | integer | 32 | NO | 0 | 下次跟进时间 | 
| remark | text | 0 | YES | '' | 跟进内容 | 
| status | smallint | 16 | NO | 0 | 资源状态 | 
| ctime | integer | 32 | NO | 0 | 创建时间 | 
| cuid | integer | 32 | NO | 0 | 修改者 | 
| mtime | integer | 32 | NO | 0 |  -  | 
| muid | integer | 32 | NO | 0 |  -  | 
| follow_time | integer | 32 | NO | 0 | 最后跟进时间 | 
| edu_agency | smallint | 16 | NO | 0 | 已经在读机构 | 
| is_student | integer | 32 | NO | 0 | 签约学员（1.是，0.否） | 
| intention_subject | character varying | 0 | NO | 0 | 意向科目 | 
| intention_classmode | character varying | 0 | NO | 0 | 意向班型 | 
| intention_classtime | character varying | 0 | NO | 0 | 意向上课时间 | 
| with_demand | character varying | 0 | NO | 0 | 补习需求 | 
| expense_budget | smallint | 16 | NO | 0 | 费用预算 | 
| intention_teacher | character varying | 0 | NO | 0 | 意向老师类型 | 
| expectations | character varying | 0 | NO | 0 | 对孩子期望 | 
| kids_character | smallint | 16 | NO | 0 | 孩子的性格 | 
| intention_level | smallint | 16 | NO | 0 | 意向级别 | 
| crm_introducer | character varying | 0 | YES | '' | 介绍人 | 
| is_visit | smallint | 16 | NO | 0 | 是否已上门 1是 2否 | 
| is_reservation | smallint | 16 | NO | 0 | 是否预约试听 1是 2否 | 
| parent_mobile2 | character varying | 0 | YES | '' | 家长电话 | 
| parent_name2 | character varying | 0 | YES | '' | 家长姓名 | 
| visit_date | integer | 32 | NO | 0 | 到访日期 | 
| is_invitation | smallint | 16 | NO | 0 | 是否邀约 1是 2否 | 
| inviter | integer | 32 | NO | 0 | 邀约人 | 
| promise_to_visit | smallint | 16 | NO | 0 | 承诺到访 1是 2否(作废) | 
| promise_visit_date | integer | 32 | NO | 0 | 承诺到访日期(作废) | 
| crm_campus | character varying | 0 | NO | '' |  -  | 
| crm_assistant | character varying | 0 | NO | '' |  -  | 
| is_market | integer | 32 | NO | 0 | 是否分配0没有 1 有 | 
| s_id | integer | 32 | NO | 0 | 正式学员id | 
| plan_id | integer | 32 | NO | 0 | 计划ID | 
| activity_id | integer | 32 | NO | 0 | 活动ID | 
| source_from_20190214 | integer | 32 | NO | 0 | 2019年2月14日保存 | 
| is_yx | smallint | 16 | NO | 2 | 是否是营销中心录入 1是 2否 | 
| source_child_from | smallint | 16 | NO | 0 | 来源子类 | 
| yx_city | smallint | 16 | NO | 0 | 营销中心录入city | 
| yx_cuid | integer | 32 | NO | 0 | 营销中心录入人id | 
| yx_ctime | integer | 32 | NO | 0 | 营销中心录入时间 | 
| is_sc | smallint | 16 | NO | 2 | 是否是市场部录入 1是 2否 | 
| is_in_campus | smallint | 16 | NO | 2 | 1存在校区关联表 2不存在校区关联表 | 
| is_call | smallint | 16 | NO | 2 | 是否呼出 | 
| is_add_wx | smallint | 16 | NO | 2 | 是否添加微信 | 
| area | integer | 32 | NO | 0 | 区域 | 
| school_id | integer | 32 | NO | 0 | 学校ID | 
| preparation_number | integer | 32 | NO | 0 | 备单数量 | 
| supervisor_id | integer | 32 | NO | 0 | 监管人id | 
| supervisor_name | character varying | 0 | NO | 0 | 监管人姓名 | 
| family_financial_situation | text | 0 | NO | 0 | 家庭经济情况 | 

### 8.  `nice_crm2_student_transfer_log` 资源分配日志
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| cuid | integer | 32 | NO | 0 | 操作人 | 
| ctime | integer | 32 | NO | 0 | 创建时间 | 
| ymd | integer | 32 | NO | 0 | 创建时间 | 
| student_id | integer | 32 | NO | 0 | 资源ID | 
| assistant_id | integer | 32 | NO | 0 | 咨询师ID | 
| city | integer | 32 | NO | 0 | 分公司 | 
| campus | integer | 32 | NO | 0 | 校区 | 

### 9.  `nice_crm2_tmp` 
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | id | 
| student_name | character varying | 0 | YES | '' | 学生姓名 | 
| parent_mobile | character varying | 0 | YES | '' | 家长电话 | 
| school | character varying | 0 | YES | '' | 学校 | 
| grade_str | character varying | 0 | YES | '' | 年级 | 
| grade | smallint | 16 | NO | 0 | 年级 | 
| is_run | smallint | 16 | NO | 0 | 是否执行 | 
| is_success | smallint | 16 | NO | 0 | 是否成功 | 

### 10.  `nice_crm2_visit` 上门记录表
| 字段名 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | ---- | -------- | ------ | ---- |
| id | integer | 32 | NO | '' | ID | 
| student_id | integer | 32 | NO | 0 | 资源ID | 
| source_from | integer | 32 | NO | 0 | 来源(无效) | 
| city | integer | 32 | NO | 0 | 分公司 | 
| campus | integer | 32 | NO | 0 | 校区 | 
| contact_uid | integer | 32 | NO | 0 | 接触人 | 
| visit_time | integer | 32 | NO | 0 | 上门时间 | 
| ymd | integer | 32 | NO | 0 | 上门时间 | 
| remark | text | 0 | YES | '' | 备注 | 
| cuid | integer | 32 | NO | 0 | 录入人 | 
| ctime | integer | 32 | NO | 0 | 录入时间 | 
| muid | integer | 32 | NO | 0 | 修改人 | 
| mtime | integer | 32 | NO | 0 | 修改时间 | 
| is_effective | smallint | 16 | NO | 2 | 是否是有效上门(1:是 2:不是) | 

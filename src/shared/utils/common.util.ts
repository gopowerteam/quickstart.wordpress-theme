import dayjs from "dayjs"

/**
 * 列表数据转换为树形数据
 * @param param
 */
export function convertToTree(
    data,
    {
        key,
        parentKey,
        defaultParent
    }: { key: string; parentKey: string; defaultParent?: any }
) {
    // 获取根节点
    const roots = data.filter(
        x => !x[parentKey] || x[parentKey] === defaultParent
    )

    const action = item => {
        // 获取子节点
        const children = data.filter(x => x[parentKey] === item[key])

        if (children && children.length > 0) {
            return {
                ...item,
                children: children.map(action)
            }
        } else {
            return {
                ...item
            }
        }
    }

    return roots.map(action)
}

/**
 * 数据分组
 * @param data
 * @param key
 * @returns
 */
export function groupBy(data: any[], key: string) {
    return data.reduce((result, item) => {
        result[item[key]] = [...(result[item[key]] || []), item]
        return result
    }, {})
}


export function dateFormat(date, template) {
    return dayjs(date).format(template)
}
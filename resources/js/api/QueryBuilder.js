/** Example
 const test = new QueryBuilder()
 test.setFields('users', ['email', 'first_name', 'id'])
 .setFields('addresses.city', ['name', 'id'])
 .setFilter('name', ['Mike', 'kk'])
 .setInclude(['properties', 'addresses.city'])
 .setSort(['-first_name', 'addresses']) // use '-' for desc
 let element = document.querySelector('p')
 element.innerHTML = test.get()
 */

export default  class QueryBuilder {

    constructor() {
        this.clear()
    }

    clear(){
        this.fields = {}
        this.include = []
        this.filters = {}
        this.sort = []
    }

    setFields(table, fields) {
        this.fields[table] = fields
        return this
    }

    setInclude(include) {
        this.include = include
        return this
    }

    setFilter(attribute, values) {
        this.filters[attribute] = values
        return this
    }

    setSort(sort) {
        this.sort = sort
        return this
    }

    get(){
        let query = []

        //add fields
        query.push(this.getFields())

        //add includes
        query.push(this.getIncludes())

        //add filters
        query.push(this.getFilters())

        //add sort field
        query.push(this.getSort())

        //filter query elements
        query = query.filter(item => item !== '')

        return query.length > 0 ? '?'+query.join('&') : ''
    }


    getSort(){
        return this.sort.length > 0 ? `sort=${this.sort.join(',')}` : ''
    }

    getFields(){
        return this.stringifyArraybleObject(this.fields, 'fields', ',', '&')
    }


    getFilters(){
        return this.stringifyArraybleObject(this.filters, 'filter', ',', '&')
    }

    getIncludes(){
        if(this.include.length === 0){
            return ''
        }

        return `include=${this.include.join(',')}`
    }

    stringifyArraybleObject(arraybleObject, keyPrefix, itemsJoin, keyJoin ){
        if(Object.keys(arraybleObject).length === 0)
        {
            return ''
        }

        let keyString = []
        for (const key in arraybleObject)
        {
            keyString.push( `${keyPrefix}[${key}]=${arraybleObject[key].join(itemsJoin)}`)
        }

        return keyString.join(keyJoin)
    }
}




export class Kenteken {
    constructor(public kenteken: string) {}

    isValid() {
        if(this.kenteken)
            return true
        
        return false
    }
}
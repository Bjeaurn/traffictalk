import {Injectable} from '@angular/core'

@Injectable()
export class UserService {
    private id: string
    setUser(id: string) {
        this.id = id
    }

    isLoggedIn() {
        return this.id !== undefined
    }

    getUser(): string {
        return this.id
    }
}
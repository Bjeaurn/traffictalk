import { UserService } from '../shared/user.service'
import {Component} from '@angular/core'
import {Router} from '@angular/router'

@Component({
    selector: 'app-home',
    template: `
        <div class="jumbotron">
            <span class="text-center">
                <app-kenteken></app-kenteken>
            </span>
        </div>
        <div class="col-md-6">
            <h3>Top deze week</h3>
        </div>
        <div class="col-md-6">
             <h3>Top afgelopen maand</h3>
        </div>
    `
})
export class HomeComponent {

    constructor(private router: Router, private userService: UserService) {
        this.userService.setUser("testHurrDurr")
    }
}
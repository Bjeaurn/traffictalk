import {NgModule} from '@angular/core'
import {MenuComponent} from './menu/menu.component'
import {SharedModule} from '../shared/shared.module'

@NgModule({
    declarations: [
        MenuComponent
    ],
    imports: [
        SharedModule
    ],
    exports: [
        MenuComponent
    ]
})
export class BaseModule {}
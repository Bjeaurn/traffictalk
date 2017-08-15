import { NgModule } from '@angular/core'
import { RouterModule, Routes } from '@angular/router'
import { HomeComponent } from './home.component'
import { KentekenComponent } from './kenteken/kenteken.component'

const homeRoutes: Routes = [
    { path: 'home', component: HomeComponent },
    { path: '', redirectTo: '/home', pathMatch: 'full' },
]

@NgModule({
    imports: [
        RouterModule.forRoot(homeRoutes)
    ],
    declarations: [
        HomeComponent,
        KentekenComponent
    ],
    exports: [
        KentekenComponent
    ]
})
export class HomeModule {}
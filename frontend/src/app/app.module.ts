import { BrowserModule } from '@angular/platform-browser'
import { NgModule } from '@angular/core'
import { FormsModule } from '@angular/forms'
import { HttpClientModule } from '@angular/common/http'
import { CommonModule } from '@angular/common'
import { AppComponent } from './app.component'
import { RouterModule, Routes } from '@angular/router'
import { SharedModule } from './shared/shared.module'
import { BaseModule } from './base/base.module'
import { HomeModule } from './intro/home.module'
import { CarModule } from './car/car.module'
import { PageNotFoundComponent } from "./shared/pagenotfound.component"

const appRoutes: Routes = [
  { path: '**', component: PageNotFoundComponent }
]

@NgModule({
  declarations: [
    AppComponent,
    PageNotFoundComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    SharedModule,
    BaseModule,
    CarModule,
    HomeModule,
    RouterModule.forRoot(appRoutes, { enableTracing: false } ),
  ],
  exports: [
    RouterModule
  ],
  providers: [
    HttpClientModule
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

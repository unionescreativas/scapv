<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card body-class=" profile-page p-0">
          <template v-slot:body>
            <div class="profile-header">
              <div class="cover-container">
                <!-- <action-user /> -->
                <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                  <li>
                    <b-link href="javascript:void(0);"><i class="ri-pencil-line"></i></b-link>
                  </li>
                  <li>
                    <b-link href="javascript:void(0);"><i class="ri-settings-4-line"></i></b-link>
                  </li>
                </ul>
              </div>

              <div class="profile-info mt-5 p-4">
                <b-row>
                  <b-col md="6" sm="12">
                    <div class="user-detail pl-5">
                      <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img pr-4">
                          <b-img v-bind:src="user.profile" alt="profile-img" fluid class="avatar-130" />
                        </div>
                        <div class="profile-detail d-flex align-items-center">
                          <h3>{{ user.name }}</h3>
                          <p class="m-0 pl-3">{{ user.role }}</p>
                        </div>
                      </div>
                    </div>
                  </b-col>

                  <b-col md="6" sm="12">
                    <tab-nav :pills="true" id="pills-tab" class="profile-feed-items d-flex justify-content-end">
                      <tab-nav-items
                        :active="false"
                        id="pills-feed-tab"
                        href="#informacion-personal"
                        role="tab"
                        :ariaSelected="false"
                        title="Información Personal"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#otra-informacion"
                        role="tab"
                        :ariaSelected="false"
                        title="Otra Información"
                      />
                    </tab-nav>
                  </b-col>
                </b-row>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12">
        <tab-content>
          <tab-content-item :active="false" id="informacion-personal" aria-labelled-by="informacion-personal">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Información Personal</h4>
              </template>
              <template v-slot:body>
                <div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore adipisci praesentium nisi, dolor quia at
                  id eos. Aliquam, obcaecati! Perspiciatis placeat, magnam suscipit debitis dolores architecto ut animi
                  tenetur vero!
                </div>
              </template>
            </iq-card>
          </tab-content-item>
          
          <tab-content-item :active="false" id="otra-informacion" aria-labelled-by="otra-informacion">
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Otra Información</h4>
              </template>
              <template v-slot:body>
                <div>
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus a unde neque vel asperiores deleniti
                  sunt ab ad tenetur necessitatibus expedita harum id nihil blanditiis dolorem debitis odio maiores esse
                  nostrum soluta qui, ea obcaecati et quos! Explicabo illum itaque voluptas quod provident, ipsam mollitia ex
                  commodi magni aliquid illo?
                </div>
              </template>
            </iq-card>
          </tab-content-item>
        </tab-content>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  data: () => ( {
      user: {
        profile: require('~/assets/images/user/user-11.png'),
        name: 'Nik Jone',
        role: ' - Web designer',
        about: 'Lorem ipsum dolor sit amet, contur adipiscing elit.',
        email: 'nikjone@demoo.com',
        phone: '001 2351 256 12',
        location: 'USA',
        careated_date: '07 Jan 2020'
      },
      galary: [
        { image: require('~/assets/images/page-img/g1.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g2.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g3.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g4.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g5.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g6.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g7.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g8.jpg'), href: 'javascript:void(0);' },
        { image: require('~/assets/images/page-img/g9.jpg'), href: 'javascript:void(0);' }
      ],
      timelineItems: [
        {
          color: 'primary',
          title: 'Client Login',
          right: '24 November 2019',
          description: 'Bonbon macaroon jelly beans gummi bears jelly lollipop apple',
          child: {
            type: 'img',
            items: [
            ]
          }
        },
        {
          color: 'success',
          title: 'Scheduled Maintenance',
          right: '23 November 2019',
          description: 'Bonbon macaroon jelly beans gummi bears jelly lollipop apple',
          child: {
            type: 'img',
            items: [
            ]
          }
        },
        {
          color: 'danger',
          title: 'Dev Meetup',
          right: '20 November 2019',
          description: 'Bonbon macaroon jelly <b-link href="">beans gummi</b-link> bears jelly lollipop apple',
          child: {
            type: 'img',
            items: [
              require('~/assets/images/user/user-05.jpg'),
              require('~/assets/images/user/user-06.jpg'),
              require('~/assets/images/user/user-07.jpg'),
              require('~/assets/images/user/user-08.jpg'),
              require('~/assets/images/user/user-09.jpg'),
              require('~/assets/images/user/user10.jpg')
            ]
          }
        },
        {
          color: 'primary',
          title: 'Client Call',
          right: '19 November 2019',
          description: 'Bonbon macaroon jelly beans gummi bears jelly lollipop apple',
          child: {
            type: 'img',
            items: [
            ]
          }
        },
        {
          color: 'warning',
          title: 'Mega Event',
          right: '15 November 2019',
          description: 'Bonbon macaroon jelly beans gummi bears jelly lollipop apple',
          child: {
            type: 'img',
            items: [
            ]
          }
        }
      ],
      friends: [
        { name: 'Paul Molive', role: 'Web Designer', image: require('~/assets/images/user/user-01.jpg') },
        { name: 'Paul Molive', role: 'trainee', image: require('~/assets/images/user/user-01.jpg') },
        { name: 'Anna Mull', role: 'Web Developer', image: require('~/assets/images/user/user-02.jpg') },
        { name: 'Paige Turner', role: 'trainee', image: require('~/assets/images/user/user-03.jpg') },
        { name: 'Barb Ackue', role: 'Web Designer', image: require('~/assets/images/user/user-04.jpg') },
        { name: 'Greta Life', role: 'Tester', image: require('~/assets/images/user/user-05.jpg') },
        { name: 'Ira Membrit', role: 'Android Developer', image: require('~/assets/images/user/user-06.jpg') },
        { name: 'Pete Sariya', role: 'Web Designer', image: require('~/assets/images/user/user-07.jpg') }
      ],
      userBio: [
        { title: 'Joined', description: 'November 15, 2012' },
        { title: 'Lives', description: 'United States of America' },
        { title: 'Email', description: '<a href="mailto:nikjone@gmail.com"> nikjone@gmail.com</a>' },
        { title: 'Url', description: '<a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank"> www.bootstrap.com </a>' },
        { title: 'Contact', description: '<a href="tel:001 4544 565 456">(001) 4544 565 456</a>' }
      ],
      story: [
        { title: 'Web Design', time: '1 hour ago', image: require('~/assets/images/page-img/s1.jpg'), class: 'mb-4', isActive: 'active' },
        { title: 'App Design', time: '4 hour ago', image: require('~/assets/images/page-img/s2.jpg'), class: 'mb-4', isActive: '' },
        { title: 'Abstract Design', time: '9 hour ago', image: require('~/assets/images/page-img/s3.jpg'), class: '', isActive: '' }
      ],
      suggestions: [
        { name: 'Paul Molive', mutual_friend: '4 mutual friends', image: require('~/assets/images/user/user-01.jpg') },
        { name: 'Paul Molive', mutual_friend: '4 mutual friends', image: require('~/assets/images/user/user-01.jpg') },
        { name: 'Anna Mull', mutual_friend: '6 mutual friends', image: require('~/assets/images/user/user-02.jpg') },
        { name: 'Paige Turner', mutual_friend: '8 mutual friends', image: require('~/assets/images/user/user-03.jpg') },
        { name: 'Barb Ackue', mutual_friend: '1 mutual friends', image: require('~/assets/images/user/user-04.jpg') },
        { name: 'Greta Life', mutual_friend: '3 mutual friends', image: require('~/assets/images/user/user-05.jpg') },
        { name: 'Ira Membrit', mutual_friend: '12 mutual friends', image: require('~/assets/images/user/user-06.jpg') },
        { name: 'Pete Sariya', mutual_friend: '2 mutual friends', image: require('~/assets/images/user/user-07.jpg') }
      ],
      news: [
        { description: 'there is a meetup in your city on friday at 19:00.<a href="#">see details</a>' },
        { description: '20% off coupon on selected items at pharmaprix' }
      ],
      twitterFeed: [
        {
          image: require('~/assets/images/page-img/42.jpg'),
          name: 'UI/Ux Designer',
          description: 'Creativity Design'
        },
        {
          image: require('~/assets/images/page-img/43.jpg'),
          name: 'Marketing',
          description: 'Accounting'
        },
        {
          image: require('~/assets/images/page-img/44.jpg'),
          name: 'Web Developer',
          description: 'uniq Concept'
        },
        {
          image: require('~/assets/images/page-img/45.jpg'),
          name: 'Latest News',
          description: 'Line information'
        }
      ],
      recentPages: [
        {
          image: require('~/assets/images/page-img/46.jpg'),
          name: 'Food town'
        },
        {
          image: require('~/assets/images/page-img/47.jpg'),
          name: 'Touro Univercity'
        },
        {
          image: require('~/assets/images/page-img/48.jpg'),
          name: 'Moviehouse & Eatery'
        },
        {
          image: require('~/assets/images/page-img/49.jpg'),
          name: 'Coffee + Crisp'
        }
      ]
    }),
  mounted() {
    vito.index();
  },
};
</script>

import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head } from '@inertiajs/react';
import Audio from './Audio';
import Swiper from '@/Components/Swiper';
import MySwiper from '@/Components/MySwiper';
import React, { useRef } from 'react';
import { Container, styled } from '@mui/material';



export default function Dashboard({ auth }) {
    const MyContainer = styled('div')({
        width: '95%',
        marginLeft: 'auto'
    });
    return (
        <DashboardLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Head title="Welcome" />
            <MyContainer>
                <Swiper />
                <Swiper />
                <Swiper />
                {/* <MySwiper></MySwiper> */}
                <Audio></Audio>
            </MyContainer>
        </DashboardLayout>
    );
}






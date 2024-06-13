<?php

namespace App\Repositories\Booking;

use Exception;

use App\Models\Booking;

class GetBookingByUserIdRepository
{
    public function getBookingById($user_id)
    {
        try{
            $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
                ->select('bookings.*', 'users.fullName', 'users.nickname', 'users.phoneNumber')
                ->where('bookings.user_id', $user_id)
                ->get();

            $bookingDTOs = [];

            foreach ($bookings as $booking) {
                $bookingDTO = [
                    'id' => $booking->id,
                    'nomorMeja' => $booking->nomorMeja,
                    'jamAmbil' => $booking->jamAmbil,
                    'statusAmbil' => $booking->statusAmbil,
                    'user_fullName' => $booking->fullName,
                    'user_nickname' => $booking->nickname,
                    'user_phoneNumber' => $booking->phoneNumber
                ];

                array_push($bookingDTOs, $bookingDTO);
            }

            return $bookingDTOs;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}

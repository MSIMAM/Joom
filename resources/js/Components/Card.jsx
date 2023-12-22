import * as React from 'react';
import Box from '@mui/material/Box';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import CardActions from '@mui/material/CardActions';
import Button from '@mui/material/Button';
import Typography from '@mui/material/Typography';

export default function SimpleCard() {
  return (
    <Box sx={{height:300 , display:'flex', justifyContent:'center',alignItems:'center'}}>
      <Card sx={{ maxWidth: 280 }}>
        <CardContent>
          <Typography sx={{ fontSize: 15 }} color="text.secondary">
            Software House
          </Typography>
          <Typography variant="h5">
            Educative
          </Typography>
          <Typography sx={{ mb: 2 }} color="text.secondary">
            TechEd Company
          </Typography>
          <Typography variant="body1">
            Educating people with text based content.
          </Typography>
        </CardContent>
        <CardActions>
          <Button variant = 'contained' size="large">Join</Button>
        </CardActions>
      </Card>
    </Box>
  );
}

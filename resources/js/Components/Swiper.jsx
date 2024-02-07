
import * as React from 'react';
import styled from '@emotion/styled';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import CardMedia from '@mui/material/CardMedia';
import Typography from '@mui/material/Typography';
import { CardActionArea } from '@mui/material';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Button from '@mui/material/Button';
import IconButton from '@mui/material/IconButton';
import MenuIcon from '@mui/icons-material/Menu';
import { Link } from '@inertiajs/react';
import image from '../../../public/asset/img/paella.jpg'


const Swiper = styled('div')({
  height: 'auto',
  width: '100%',
  background: '#222',
  padding: '20px',
  overflowX: 'auto',
  display: 'flex',
  gap: '20px',
  borderRadius: 10,
  '&::-webkit-scrollbar': {
    height: '0'
  }
});
const Col = styled('div')({
  background: '#222',
  minWidth: '300px'
});

const MainBody = styled('div')({
  background: '#222',
  padding: '15px',
  paddingTop: '20px',
  marginBottom: 30,
  borderRadius: '10px'
});
const ExpandMore = styled((props) => {
  const { expand, ...other } = props;
  return <IconButton {...other} />;
})(({ theme, expand }) => ({
  transform: !expand ? 'rotate(0deg)' : 'rotate(180deg)',
  marginLeft: 'auto',
  transition: theme.transitions.create('transform', {
    duration: theme.transitions.duration.shortest,
  }),
}));


export default function App({sliderRef}) {
  const [expanded, setExpanded] = React.useState(false);

  const handleExpandClick = () => {
    setExpanded(!expanded);
  };


  // After the import statements
  const settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 3, // Set the number of visible slides at a time
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  };


  return (
    <MainBody>
      <Box sx={{ flexGrow: 1 }}>
        <AppBar position="static" sx={{ marginBottom: '15px', borderRadius: '10px' }}>
          <Toolbar>
            <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
              Trending Songs
            </Typography>
            <Link sx={{ color: '#222' }} href='#' className='link-color'>VIEW ALL</Link>
          </Toolbar>
        </AppBar>
      </Box>
      <Swiper rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }} className='scroll'>
        {Array.from(Array(6)).map((_, index) => (
          <Col>
            <Card sx={{ maxWidth: 345 }}>
              <CardActionArea>
                <CardMedia
                  component="img"
                  height="140"
                  image={image}
                  alt="green iguana"
                />
                <CardContent>
                  <Typography gutterBottom variant="h5" component="div">
                    Lizard
                  </Typography>
                  <Typography variant="body2" color="text.secondary">
                    Lizards are a widespread group of squamate reptiles, with over 6,000
                    species, ranging across all continents except Antarctica
                  </Typography>
                </CardContent>
              </CardActionArea>
            </Card>
          </Col>
        ))}
      </Swiper>
    </MainBody>
  );
}
